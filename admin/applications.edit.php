<?php

include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.ApplicationsTable");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.RegionsTable");

class IndexPage extends AdminPage {

	/**
	 *
	 * @var ApplicationsTable
	 */
	var $applicationsTable;
	/**
	 *
	 * @var CountriesTable
	 */
	var $countriesTable;
	/**
	 *
	 * @var RegionsTable
	 */
	var $regionsTable;

	var $data = false;

	function index() {
		parent::index();

		$this->setPageTitle('Данные заявки');
		$this->setBoldMenu('applications');

		$this->applicationsTable = new ApplicationsTable($this->connection);
		$this->countriesTable = new CountriesTable($this->connection);
		$this->regionsTable = new RegionsTable($this->connection);

		$intApplicationID = $this->request->getNumber('intApplicationID', null, 0);

		if ($intApplicationID) {
			$this->data = $this->applicationsTable->Get(array('intApplicationID'=>$intApplicationID));

			if (empty($this->data)) {
				$this->addErrorMessage('Такой заявки нет');
				$this->response->redirect('applications.php');
			}
		}
	}

 	function OnSave() {
		$data['intApplicationID'] = $this->request->getNumber('intApplicationID');
		$data['intRegionID'] = $this->request->getString('intRegionID', 'NotEmpty');
		if (!empty($data['intRegionID'])) {
			$region = $this->regionsTable->Get(array('intRegionID' => $data['intRegionID']));
			$data['intCountryID'] = $region['intCountryID'];
		}
		$data['varTourName'] = $this->request->getString('varTourName');
		$data['varHotelName'] = $this->request->getString('varHotelName');
		$data['varDateFrom'] = $this->request->getDate('varDateFrom');
		$data['varDateTo'] = $this->request->getDate('varDateTo');
		$data['varCountPersons'] = $this->request->getString('varCountPersons');
		$data['varRoomType'] = $this->request->getString('varRoomType');
		$data['varCountRooms'] = $this->request->getString('varCountRooms');
		$data['varPayType']	= $this->request->getString('varPayType');
		$data['varAppComments']	= $this->request->getString('varAppComments');
		$data['varPrice'] = $this->request->getString('varPrice');
		$data['varStatus']	= $this->request->getString('varStatus'); // для public-части будет 'pending'
		$data['varPersonFirstName']	= $this->request->getString('varPersonFirstName');
		$data['varPersonLastName']	= $this->request->getString('varPersonLastName');
		$data['varPersonEmail']	= $this->request->getString('varPersonEmail');
		$data['varPersonAddress'] = $this->request->getString('varPersonAddress');
		$data['varPersonPhoneFax'] = $this->request->getString('varPersonPhoneFax');
		$data['varPersonComments'] = $this->request->getString('varPersonComments');
		$data['varIsNew'] = 'no';
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			
			if (!empty($data['intApplicationID'])) {
				$this->applicationsTable->Update($data);
			} else {
				$this->applicationsTable->Insert($data);
			}

			$this->addMessage('Данные успешно сохранены');
			if (!empty($data['intApplicationID'])) $this->response->redirect('applications.edit.php?intApplicationID='.$data['intApplicationID']);
		}
	}

	function render() {
		parent::render();

		$this->document->addValue('countries_list', $this->countriesTable->getList(null, array('varName'=>'asc')));
		$this->document->addValue('regions_list', $this->regionsTable->getList(null, array('varName'=>'asc'), null, 'GetListWithCountryName', 'getSQLRows'));
		$this->document->addValue('data', $this->data);
	}

}

Kernel::ProcessPage(new IndexPage("applications.edit.tpl"));