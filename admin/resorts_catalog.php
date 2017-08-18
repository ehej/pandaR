<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.ResortsTable");
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
	var $ResortsTable;
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
		
		$this->setPageTitle('Курорты');
		$this->setBoldMenu('resortsCatalog');
		
		$this->countriesTable = new CountriesTable($this->connection);
		$this->ResortsTable = new ResortsTable($this->connection);
		$this->hotelsTable = new HotelsTable($this->connection);
		$this->departureCitiesTable = new DepartureCitiesTable($this->connection);
		$this->specialOffersTable = new SpecialOffersTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$data = array('intResortID' => $this->request->getNumber('intResortID'));
		
		$hotels = $this->hotelsTable->GetList($data);
		
		if(count($hotels) > 0) {
			$this->addErrorMessage('Нельзя удалить курорт, т.к. есть связанные с ним отели или города вылета');
		} else {
			$this->ResortsTable->Delete($data);
			$this->addMessage('Курорт удален');
			$this->response->redirect('resorts_catalog.php');
		}
	}
	
	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'varName');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varName')) && !empty($name)) $this->sfilter['LIKEvarName'] = $name;
		if ( ($name = $this->request->getString('intCountryID')) && !empty($name)) $this->sfilter['intCountryID'] = $name;

		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}

	function render() {
		parent::render();
		
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC';
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);
		$tmp = $this->countriesTable->GetList();
		foreach($tmp as $v){
			$countries[$v['intCountryID']] = $v;
		}
		$this->document->addValue('countries_list', $countries);
		$tmp = array();
		$resorts_list = $this->ResortsTable->GetList($this->sfilter, $sort, null, 'GetListWithCountryName', 'getSQLRows', true, $this->page, DEFAULT_ITEMSPERPAGE);
		
		foreach ($resorts_list as $key => $value) {
			if(!is_integer($key)){
				$pager = $value;
			}else{
				$value['varIdentifier'] = $value['intResortID'];
				$value['varModule'] = 'resort';
				$value['link'] = LinkCreator::create($value, $this->all_alias);
				$tmp[] = $value;
			}
			
		}
		if(isset($pager))$tmp['pager'] = $pager;
	   
		$resorts_list = $tmp;	
		$this->document->addValue('resorts_list', $resorts_list);
	}

}

Kernel::ProcessPage(new IndexPage("resorts_catalog.tpl"));