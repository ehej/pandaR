<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.UkrainianAreaTable");
Kernel::Import("classes.data.UkrainianCityTable");

class IndexPage extends AdminPage {

	var $UkrainianAreaTable;
	var $UkrainianCityTable;
	var $data = false;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных города');
		$this->setBoldMenu('ukrainian_city');		
		
		$this->UkrainianAreaTable = new UkrainianAreaTable($this->connection);
		$this->UkrainianCityTable = new UkrainianCityTable($this->connection);
		
		$intCityID = $this->request->getNumber('intCityID', 0);
		if ($intCityID) {
			$this->data = $this->UkrainianCityTable->Get(array('intCityID' => $intCityID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет области с заданным ID');
				$this->response->redirect('ukrainian_city.php');
			}
		}
	}

 	function OnSave() {
		$data['intCityID'] = $this->request->getNumber('intCityID');
		$data['intAreaID'] = $this->request->getNumber('intAreaID');
		$data['varName'] =	$this->request->getString('varName', 'NotEmpty');
		$data['isActive'] = $this->request->getNumber('isActive');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if (isset($data['intCityID']) && !empty($data['intCityID'])) {
				$this->UkrainianCityTable->Update($data);
			} else {
				$this->UkrainianCityTable->Insert($data);
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intCityID']) && !empty($data['intCityID'])) $this->response->redirect('ukrainian_city.edit.php?intCityID='.$data['intCityID']);
		}
	}


	
	function render() {
		parent::render();
	
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('data', $this->data);		
		$area_list = $this->UkrainianAreaTable->GetList(null, array('varName'=>'ASC'));
		$this->document->addValue('area_list', $area_list);
	}
}

Kernel::ProcessPage(new IndexPage("ukrainian_city.edit.tpl"));