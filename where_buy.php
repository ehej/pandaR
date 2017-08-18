<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.WhereBuyTable");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.CountriesToWhereBuyTable");
Kernel::Import("classes.data.ModulesPagesTable");
Kernel::Import("classes.data.UkrainianAreaTable");
Kernel::Import("classes.data.UkrainianCityTable");

class IndexPage extends PublicPage {

	/**
	 * @var WhereBuyTable
	 */
	var $whereBuyTable;
	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	/**
	 * @var CountriesToWhereBuyTable
	 */
	var $countriesToWhereBuyTable;
	/**
	 * @var DepartureCitiesTable
	 */
	var $departureCitiesTable;
	/**
	 * @var ModulesPagesTable
	 */
	var $modulesPagesTable;
	var $UkrainianAreaTable;
	var $UkrainianCityTable;
	
	var $data = array();
	
	function index() {
		parent::index();

		$this->whereBuyTable 				= new WhereBuyTable($this->connection);
		$this->countriesToWhereBuyTable 	= new CountriesToWhereBuyTable($this->connection);
		$this->countriesTable 				= new CountriesTable($this->connection);
		$this->modulesPagesTable 			= new ModulesPagesTable($this->connection);
		$this->UkrainianAreaTable 			= new UkrainianAreaTable($this->connection);
		$this->UkrainianCityTable 			= new UkrainianCityTable($this->connection);
		
		$fields = $this->modulesPagesTable->GetByFields(array('varPage' => 'where_buy'), null, true);
		$this->setPageTitle($fields['varMetaTitle'], $fields['varMetaKeywords'], $fields['varMetaDescription']);
	}

	function render() {
		parent::render();
			
		$intAreaID = $this->request->getNumber('intAreaID', 0);
		if(!empty($intAreaID)) { 
			$this->data['intAreaID'] = $intAreaID;
			$this->document->addValue('intAreaID', $this->data['intAreaID']);
		}
		$intCityID = $this->request->getNumber('intCityID', 0);
		if(!empty($intCityID)) { 
			$this->data['intCityID'] = $intCityID;
			$this->document->addValue('intCityID', $this->data['intCityID']);
		}
		$this->page = $this->request->getNumber('page', null, 1);
		if($intAreaID != 0 || $intCityID != 0){
			$wb = $this->whereBuyTable->GetList($this->data, array('varMIBSAgency'=>'ASC', 'varName'=>'ASC'), null, null, 'getSQLRows', true, $this->page, 30);
			$this->document->addValue('data', $wb);
		}
		
		
		$this->document->addValue('countries', $this->countriesTable->GetList());
		$area_list = $this->UkrainianAreaTable->GetList(null, array('varName'=>'ASC'));
		$this->document->addValue('area_list', $area_list);
		$city_list = $this->UkrainianCityTable->GetList(null, array('varName'=>'ASC'));
		$this->document->addValue('city_list', $city_list);
		$this->breadCrumbs = array(
			array(
				'title'=>'Главная',
				'url'=>'/',
				'thisPage'=>false
			),
			array(
				'title'=>'Где купить',
				'url'=>'/where-buy',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);
	}
}

Kernel::ProcessPage(new IndexPage("where_buy.tpl"));