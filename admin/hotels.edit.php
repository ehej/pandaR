<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.HotelsTable");
Kernel::Import("classes.data.HotelsTypesTable");
Kernel::Import("classes.data.RegionsTable");

class IndexPage extends AdminPage {

	/**
	 * @var HotelsTable
	 */
	var $hotelsTable;	
	/**
	 * @var HotelsTypesTable
	 */
	var $hotelsTypesTable;	
	/**
	 * @var RegionsTable
	 */
	var $regionsTable;	
	
	var $data = false;
	var $intHotelID;

	function index() {
		parent::index();
		$this->setPageTitle('Редактирование данных отеля');
		$this->setBoldMenu('hotels');		
		
		$this->hotelsTable = new HotelsTable($this->connection);	
		$this->hotelsTypesTable = new HotelsTypesTable($this->connection);	
		$this->regionsTable = new RegionsTable($this->connection);
		
		$this->intHotelID = $this->request->getNumber('intHotelID', 0);
		if ($this->intHotelID) {
			$this->data = $this->hotelsTable->Get(array('intHotelID' => $this->intHotelID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет отеля с заданным ID');
				$this->response->redirect('hotels.php');
			}
		}
	}
		
 	function OnSave() {
		$data['intHotelID'] = $this->request->getNumber('intHotelID');
		$data['varName'] =	$this->request->getString('varName', 'NotEmpty');
		$data['intRegionID'] = $this->request->getNumber('intRegionID', 'NotEmpty');
		$data['intHotelTypeID'] = $this->request->getNumber('intHotelTypeID', 'NotEmpty');
		$data['varDescription'] = $this->request->getString('varDescription', 'NotEmpty');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			
			if (isset($data['intHotelID']) && !empty($data['intHotelID'])) {
				$this->hotelsTable->Update($data);
			} else {
				$this->hotelsTable->Insert($data);
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intHotelID']) && !empty($data['intHotelID'])) $this->response->redirect('hotels.edit.php?intHotelID='.$data['intHotelID']);
		}
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('data', $this->data);
		$this->document->addValue('hotels_types_list', $this->hotelsTypesTable->GetList());
		$this->document->addValue('regions_list', $this->regionsTable->getList(null, array('varName'=>'asc'), null, 'GetListWithCountryName', 'getSQLRows'));		
	}

}

Kernel::ProcessPage(new IndexPage("hotels.edit.tpl"));