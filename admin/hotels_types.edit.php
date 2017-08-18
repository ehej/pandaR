<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.HotelsTypesTable");

class IndexPage extends AdminPage {

	/**
	 * 
	 * @var HotelsTypesTable
	 */
	var $hotelsTypesTable;

	var $data = false;

	function index() {
		parent::index();
		$this->setPageTitle('Редактирование категории отеля');
		$this->setBoldMenu('hotelstypes');

		$this->hotelsTypesTable = new HotelsTypesTable($this->connection);

		$intHotelTypeID = $this->request->getNumber('intHotelTypeID', 0);

		if ($intHotelTypeID) {
			$this->data = $this->hotelsTypesTable->Get(array('intHotelTypeID' => $intHotelTypeID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет категории отеля с заданным ID');
				$this->response->redirect('index.php');
			}
		}
	}

 	function OnSave() {
		$data['intHotelTypeID'] = $this->request->getNumber('intHotelTypeID');
		$data['varName'] = $this->request->getString('varName', 'NotEmpty');

		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if (isset($data['intHotelTypeID']) && !empty($data['intHotelTypeID'])) {
				$this->hotelsTypesTable->Update($data);
			} else {
				$this->hotelsTypesTable->Insert($data);
			}

			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intHotelTypeID']) && !empty($data['intHotelTypeID'])) {
				$this->response->redirect('hotels_types.edit.php?intHotelTypeID='.$data['intHotelTypeID']);
			}
		}
	}

	function render() {
		parent::render();

		$this->document->addValue('data', $this->data);
	}

}

Kernel::ProcessPage(new IndexPage("hotels_types.edit.tpl"));