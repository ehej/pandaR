<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.WhereBuyTable");
Kernel::Import("classes.data.CountriesToWhereBuyTable");
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
	var $UkrainianAreaTable;
	var $UkrainianCityTable;
	
	var $data = false;

	function index() {
		parent::index();
		
		$this->setPageTitle('Где купить');
		$this->setBoldMenu('where_buy');
		
		$this->whereBuyTable 				= new WhereBuyTable($this->connection);
		$this->countriesToWhereBuyTable		= new CountriesToWhereBuyTable($this->connection);
		$this->countriesTable 				= new CountriesTable($this->connection);
		$this->UkrainianAreaTable 			= new UkrainianAreaTable($this->connection);
		$this->UkrainianCityTable 			= new UkrainianCityTable($this->connection);
			
		$intWhereBuyID = $this->request->getNumber('intWhereBuyID', 0);
		if ($intWhereBuyID) {
			$this->data = $this->whereBuyTable->Get(array('intWhereBuyID' => $intWhereBuyID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет записи с заданным ID');
				$this->response->redirect('where_buy.php');
			}
		}
	}

 	function OnSave() {
		$data['intWhereBuyID'] = $this->request->getNumber('intWhereBuyID');
		$data['intAreaID'] = $this->request->getNumber('intAreaID');
		$data['intCityID'] = $this->request->getNumber('intCityID');
		$data['varName'] =	$this->request->getString('varName');
		$data['varPhone'] =	$this->request->getString('varPhone');
		$data['varDetail'] = $this->request->getString('varDetail');
		$data['varActivelyTo'] = $this->request->getDate('varActivelyTo');
		$data['varMIBSAgency'] = $this->request->getString('varMIBSAgency', null, 'N');
		$intCountryIDList = $this->request->Value('intCountryID');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if (isset($data['intWhereBuyID']) && !empty($data['intWhereBuyID'])) {
				$this->whereBuyTable->Update($data);
			} else {
				$this->whereBuyTable->Insert($data);
			}
			
			$intWhereBuyID = $data['intWhereBuyID'];
			$arrTmp = array('intWhereBuyID' => $intWhereBuyID);
			$this->countriesToWhereBuyTable->DeleteByFields($arrTmp);	
			foreach($intCountryIDList as $key => $value) {
				$d = array();
				$d['intWhereBuyID'] = $data['intWhereBuyID'];
				$d['intCountryID'] = $value;
				$this->countriesToWhereBuyTable->Insert($d);
			}
			
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intWhereBuyID']) && !empty($data['intWhereBuyID'])) $this->response->redirect('where_buy.edit.php?intWhereBuyID='.$data['intWhereBuyID']);
		}
	}

	function render() {
		parent::render();
		
		
		
		$this->document->addValue('countries_to_where_buy_list', $this->countriesToWhereBuyTable->GetList(array('intWhereBuyID' => $this->data['intWhereBuyID'])));	
		
		$this->document->addValue('countries_list', $this->countriesTable->GetList());
		$area_list = $this->UkrainianAreaTable->GetList(null, array('varName'=>'ASC'));
		$this->document->addValue('area_list', $area_list);	
		if($this->data['intAreaID'] == ''){$this->data['intAreaID'] = $area_list[0]['intAreaID'];}
		$this->document->addValue('city_list', $this->UkrainianCityTable->GetList(null, array('varName'=>'ASC')));	
		$this->document->addValue('data', $this->data);		
	}

}

Kernel::ProcessPage(new IndexPage("where_buy.edit.tpl"));