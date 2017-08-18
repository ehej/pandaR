<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.HotelsTable");
Kernel::Import("classes.data.DepartureCitiesTable");
Kernel::Import("classes.data.SpecialOffersTable");

class IndexPage extends AdminPage {
	
	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	/**
	 * @var ResortsTable
	 */
	var $resortsTable;
	/**
	 * @var RegionsTable
	 */
	var $regionsTable;
	/**
	 * @var HotelsTable
	 */
	var $hotelsTable;
	/**
	 * @var DepartureCitiesTable
	 */
	var $departureCitiesTable;
	/**
	 * @var SpecialOffersTable
	 */
	var $specialOffersTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Регионы');
		$this->setBoldMenu('regionsCatalog');
		
		$this->countriesTable = new CountriesTable($this->connection);
		$this->resortsTable = new ResortsTable($this->connection);
		$this->regionsTable = new RegionsTable($this->connection);
		$this->hotelsTable = new HotelsTable($this->connection);
		$this->departureCitiesTable = new DepartureCitiesTable($this->connection);
		$this->specialOffersTable = new SpecialOffersTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$data = array('intRegionID' => $this->request->getNumber('intRegionID'));
		
		$hotels = $this->hotelsTable->GetList($data);
		$departureCities = $this->departureCitiesTable->GetList($data);
		
		$so = $this->specialOffersTable->GetList($data);
		if(count($so) > 0) {
			$this->addErrorMessage('Нельзя удалить регион, т.к. с ним связанны записи из раздела "Спецпредложения"');
			return;
		}
		if(count($hotels) > 0 || count($departureCities) > 0) {
			$this->addErrorMessage('Нельзя удалить регион, т.к. есть связанные с ним отели или города вылета');
		} else {
			$this->regionsTable->Delete($data);
			$this->addMessage('Регион удален');
			$this->response->redirect('regions_catalog.php');
		}
	}
	
	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'varName');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varName')) && !empty($name)) $this->sfilter['LIKEvarName'] = $name;
		if ( ($name = $this->request->getString('intCountryID')) && !empty($name)){
			$this->sfilter['intCountryID'] = $name;
			
			if ( ($name = $this->request->getString('intResortID')) && !empty($name)) $this->sfilter['intResortID'] = $name;
			
			if(!$this->sfilter['intResortID']){
				$resort_list = $this->resortsTable->GetList(array('intCountryID'=>$name));
				foreach ($resort_list as $value) {
					$tmp[$value['intResortID']] = $value['intResortID'];
				}
		   		$this->sfilter['INintResortID'] = implode(',',$tmp);	
			}
		} 
		
		

		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}

	function render() {
		parent::render();
		
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC';
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);
		$tmp = $this->countriesTable->GetList(null, array('varName'=>'ASC'));
		foreach($tmp as $v){
			$countries[$v['intCountryID']] = $v;
		}
		$this->document->addValue('countries_list', $countries);
		$tmp = array();
		if($this->sfilter['intCountryID']){
			$resort_list = $this->resortsTable->GetList(array('intCountryID'=>$this->sfilter['intCountryID']), array('varName'=>'ASC'));
			foreach ($resort_list as $value) {
				$tmp[$value['intResortID']] = $value;
			}
			$resort_list = $tmp;
			$this->document->addValue('resorts_list', $resort_list );
		}
		
		
		$tmp = array();
		$region_list = $this->regionsTable->GetList($this->sfilter, $sort, null, 'GetListWithCountryName', null, true, $this->page, DEFAULT_ITEMSPERPAGE);
		
		foreach ($region_list as $key => $value) {
			if(!is_integer($key)){
				$pager = $value;
			}else{
				$value['varIdentifier'] = $value['intRegionID'];
				$value['varModule'] = 'region';
				$value['link'] = LinkCreator::create($value, $this->all_alias);
				$tmp[] = $value;
			}
		}
		if(isset($pager))$tmp['pager'] = $pager;
		$region_list = $tmp;
		$this->document->addValue('regions_list', $region_list);
	}

}

Kernel::ProcessPage(new IndexPage("regions_catalog.tpl"));