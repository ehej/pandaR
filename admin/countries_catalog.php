<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.HotelsTable");
Kernel::Import("classes.data.CountriesToWhereBuyTable");
Kernel::Import("classes.data.SpecialOffersTable");
Kernel::Import("classes.data.MenuCountriesTable");

class IndexPage extends AdminPage {
	
	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	/**
	 * @var RegionsTable
	 */
	var $regionsTable;
	/**
	 * @var HotelsTable
	 */
	var $hotelsTable;
	/**
	 * @var CountriesToWhereBuyTable
	 */
	var $countriesToWhereBuyTable;
	/**
	 * @var SpecialOffersTable
	 */
	var $specialOffersTable;
	/**
	 * @var MenuCountriesTable
	 */
	var $menuCountriesTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Страны');
		$this->setBoldMenu('countriesCatalog');
		
		$this->countriesTable = new CountriesTable($this->connection);
		$this->regionsTable = new RegionsTable($this->connection);
		$this->resortsTable = new ResortsTable($this->connection);
		$this->hotelsTable = new HotelsTable($this->connection);
		$this->countriesToWhereBuyTable = new CountriesToWhereBuyTable($this->connection);
		$this->specialOffersTable = new SpecialOffersTable($this->connection);
		$this->menuCountriesTable = new MenuCountriesTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$data = array('intCountryID' => $this->request->getNumber('intCountryID'));
		$flag = false;
		$resorts = $this->resortsTable->GetList($data);
		$mc = $this->menuCountriesTable->GetList($data);
		
		if(count($resorts) > 0) {
			$this->addErrorMessage('Нельзя удалить страну, т.к. с ней связанны регионы');
			$flag = true;
		}
		
		if($flag) {
			return;
		} else {
			if(count($mc) > 0) {
				$tmpdata = $data;
				$this->menuCountriesTable->DeleteByFields($tmpdata);
			}
			
			$this->countriesTable->Delete($data);
			$this->addMessage('Cтрана удалена');
			$this->response->redirect('countries_catalog.php');
		}
	}
	function OnSaveOrder() {
		$order = $this->request->Value('order');
		foreach($order as $key=>$val){
			$data = array(
				'intCountryID'=>$key,
				'intOrder'=>$val
			);
			$this->countriesTable->Update($data);
			$data = array(
				'intSortOrder'=>$val
			);
			$this->menuCountriesTable->UpdateByFields($data,array('intCountryID'=>$key,'intParentID'=>0));
		}
		$this->addMessage('Порядок сортировки изменен');
		$this->response->redirect('countries_catalog.php');
	}
	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'varName');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varName')) && !empty($name)) $this->sfilter['LIKEvarName'] = $name;

		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}

	function render() {
		parent::render();
		
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC';
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);
		$tmp = array();
		$countries = $this->countriesTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);
		
		foreach ($countries as $key => $value) {
			if(!is_integer($key)){
				$pager = $value;
			}else{
				$value['varIdentifier'] = $value['intCountryID'];
				$value['varModule'] = 'countries';
				$value['link'] = LinkCreator::create($value, $this->all_alias);
				$tmp[] = $value;
			}
		}
		if(isset($pager))$tmp['pager'] = $pager;

		$countries = $tmp;	
		
		$this->document->addValue('countries_list', $countries);
	}

}

Kernel::ProcessPage(new IndexPage("countries_catalog.tpl"));