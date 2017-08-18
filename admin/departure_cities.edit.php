<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.DepartureCitiesTable");
Kernel::Import("classes.data.TblDepartureCitiesTable");

class IndexPage extends AdminPage {

	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	/**
	 * @var GallerysTable
	 */
	var $gallerysTable;
	/**
	 * @var GalleriesToModulesTable
	 */
	var $galleriesToModulesTable;
	/**
	 * @var RegionsTable
	 */
	var $regionsTable;
	/**
	 * @var DepartureCitiesTable
	 */
	var $departureCitiesTable;
	/**
	 * @var TblDepartureCitiesTable
	 */
	var $tblDepartureCitiesTable;
	
	var $data = false;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных города вылета');
		$this->setBoldMenu('departure_cities');		
		
		$this->countriesTable = new CountriesTable($this->connection);
		$this->regionsTable = new RegionsTable($this->connection);
		$this->departureCitiesTable = new DepartureCitiesTable($this->connection);
		$this->tblDepartureCitiesTable = new TblDepartureCitiesTable($this->mssql_connection);
		
		$intDepadtureCityID = $this->request->getNumber('intDepadtureCityID', 0);
		if ($intDepadtureCityID) {
			$this->data = $this->departureCitiesTable->Get(array('intDepadtureCityID' => $intDepadtureCityID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет города вылета с заданным ID');
				$this->response->redirect('departure_cities.php');
			}
		}
	}

 	function OnSave() {
 		$data['intDepadtureCityID'] = $this->request->getNumber('intDepadtureCityID');	
		$data['intRegionID'] = $this->request->getNumber('intRegionID', 'NotEmpty');	
		$data['varName'] =	$this->request->getString('varName', 'NotEmpty');
		$data['intMTRegionID'] = $this->request->getNumber('intMTRegionID');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			
			if (isset($data['intDepadtureCityID']) && !empty($data['intDepadtureCityID'])) {
				$this->departureCitiesTable->Update($data);
			} else {
				$this->departureCitiesTable->Insert($data);
			}
			
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intDepadtureCityID']) && !empty($data['intDepadtureCityID'])) $this->response->redirect('departure_cities.edit.php?intDepadtureCityID='.$data['intDepadtureCityID']);
		}
	}
	
	function render() {
		parent::render();
		
		
		
		$this->document->addValue('data', $this->data);		
		$countries = $this->countriesTable->getListIDsNames();
		$this->document->addValue('countries_list', $countries);
		$this->document->addValue('json_countries_list', json_encode($countries));
		$regions = $this->regionsTable->GetList(null, array('varCountryName'=>'asc', 'varName'=>'asc'), null, 'GetListWithCountryName');
		$this->document->addValue('regions_list', $regions);
		$this->document->addValue('json_regions_list', json_encode($regions));
		//print_r($regions);
		$dep_cities_list = $this->departureCitiesTable->GetList();
		
		$this->document->addValue('dep_cities_list', $dep_cities_list);
		$this->document->addValue('t', json_encode($dep_cities_list));
		$tmp = $this->tblDepartureCitiesTable->GetList();
		$arr = array();
		foreach ($tmp as $key => $value) {
			$arr[$key]['ap_key'] = iconv('WINDOWS-1251', 'UTF-8', $value['ap_key']);
			$arr[$key]['AP_CTKEY'] = iconv('WINDOWS-1251', 'UTF-8', $value['AP_CTKEY']); // id региона
			$arr[$key]['AP_NAME'] = iconv('WINDOWS-1251', 'UTF-8', $value['AP_NAME']);
		}
//print_r($arr);
		$this->document->addValue('tbl_dep_cities_list', $arr);
		$this->document->addValue('json_tbl_dep_cities_list', json_encode($arr));
	}

}

Kernel::ProcessPage(new IndexPage("departure_cities.edit.tpl"));