<?php
include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.WhereBuyTable");
Kernel::Import("classes.data.CountriesToWhereBuyTable");
Kernel::Import("classes.data.DepartureCitiesTable");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.UkrainianAreaTable");
Kernel::Import("classes.data.UkrainianCityTable");

class IndexPage extends AdminPage {

	/**
	 * @var WhereBuyTable
	 */
	var $whereBuyTable;
	/**
	 * @var CountriesToWhereBuyTable
	 */
	var $countriesToWhereBuyTable;
	/**
	 * @var DepartureCitiesTable
	 */
	var $departureCitiesTable;
	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Где купить');
		$this->setBoldMenu('where_buy');
		
		$this->whereBuyTable 				= new WhereBuyTable($this->connection);
		$this->countriesToWhereBuyTable 	= new CountriesToWhereBuyTable($this->connection);
		$this->departureCitiesTable 		= new DepartureCitiesTable($this->connection);
		$this->countriesTable 				= new CountriesTable($this->connection);
		$this->UkrainianAreaTable 			= new UkrainianAreaTable($this->connection);
		$this->UkrainianCityTable 			= new UkrainianCityTable($this->connection);
		
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$this->addErrorMessage('Удалено');		
		$data = array('intWhereBuyID' => $this->request->getNumber('intWhereBuyID'));		
		$this->whereBuyTable->delete($data);
		$this->response->redirect('where_buy.php');
	}

	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'varPhone');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		$intAreaID = $this->request->getNumber('intAreaID', 0);
		if(!empty($intAreaID)) { $this->sfilter['intAreaID'] = $intAreaID; }
		$intCityID = $this->request->getNumber('intCityID', 0);
		if(!empty($intCityID)) { $this->sfilter['intCityID'] = $intCityID; }
		
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

		$pages = $this->whereBuyTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		$area_list = $this->UkrainianAreaTable->GetList(null, array('varName'=>'ASC'));
		$this->document->addValue('area_list', $area_list);
		$city_list = $this->UkrainianCityTable->GetList(null, array('varName'=>'ASC'));
		$this->document->addValue('city_list', $city_list);
		$this->document->addValue('where_buy_list', $pages);
		$this->document->addValue('countries_to_where_buy_list', $this->countriesToWhereBuyTable->GetList());	
		$this->document->addValue('departure_cities_list', $this->departureCitiesTable->GetList());	
		$this->document->addValue('countries_list', $this->countriesTable->GetList());	
	}	
	
}

Kernel::ProcessPage(new IndexPage("where_buy.tpl"));
