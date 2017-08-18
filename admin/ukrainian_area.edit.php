<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.UkrainianAreaTable");


class IndexPage extends AdminPage {

	var $UkrainianAreaTable;
	var $data = false;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных области');
		$this->setBoldMenu('ukrainian_area');		
		
		$this->UkrainianAreaTable = new UkrainianAreaTable($this->connection);
		
		$intAreaID = $this->request->getNumber('intAreaID', 0);
		if ($intAreaID) {
			$this->data = $this->UkrainianAreaTable->Get(array('intAreaID' => $intAreaID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет области с заданным ID');
				$this->response->redirect('ukrainian_area.php');
			}
		}
	}

 	function OnSave() {
		$data['intAreaID'] = $this->request->getNumber('intAreaID');
		$data['varName'] =	$this->request->getString('varName', 'NotEmpty');
		$data['isActive'] = $this->request->getNumber('isActive');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if (isset($data['intAreaID']) && !empty($data['intAreaID'])) {
				$this->UkrainianAreaTable->Update($data);
			} else {
				$this->UkrainianAreaTable->Insert($data);
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intAreaID']) && !empty($data['intAreaID'])) $this->response->redirect('ukrainian_area.edit.php?intAreaID='.$data['intAreaID']);
		}
	}


	
	function render() {
		parent::render();
	
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('data', $this->data);		
	}
}

Kernel::ProcessPage(new IndexPage("ukrainian_area.edit.tpl"));