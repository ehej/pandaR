<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.SubscribesTable");

class IndexPage extends AdminPage {

	var $subscribesTable;	
	var $data = false;

	function index() {
		parent::index();
		$this->setPageTitle('Редактирование данных подписчика на рассылку');
		$this->setBoldMenu('subscribes');		
		$this->subscribesTable = new subscribesTable($this->connection);		
		$intSubscribeID = $this->request->getNumber('intSubscribeID', 0);
		if ($intSubscribeID) {
			$this->data = $this->subscribesTable->Get(array('intSubscribeID'=>$intSubscribeID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет подписчика с заданным ID');
				$this->response->redirect('subscribes.php');
			}
		}
		$this->document->addValue('data', $this->data);
	}

 	function OnSave() {
 		$data['intSubscribeID'] = $this->request->getNumber('intSubscribeID');
		$data['varEmail'] =	$this->request->getString('varEmail', 'Email');
		$data['varName'] = $this->request->getString('varName');		
		$data['varPhone'] = $this->request->getString('varPhone');		
		$data['varCountry'] = $this->request->getString('varCountry');		
		$data['varCompany'] = $this->request->getString('varCompany');		
		$data['varPost'] = $this->request->getString('varPost');		
		$data['varHash'] = $this->request->getString('varHash');	
		$data['varDateAdd'] = $this->request->Value('varDateAddYear').'-'
							.$this->request->Value('varDateAddMonth').'-'
							.$this->request->Value('varDateAddDay').' '
							.$this->request->Value('varDateAddHour').':'
							.$this->request->Value('varDateAddMinute').':'
							.$this->request->Value('varDateAddSecond');	
		$data['isActive'] = $this->request->getString('isActive');		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if (isset($data['intSubscribeID']) && !empty($data['intSubscribeID'])) {
				$this->subscribesTable->Update($data);
			} else {
				$this->subscribesTable->Insert($data);
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intSubscribeID']) && !empty($data['intSubscribeID'])) $this->response->redirect('subscribes.edit.php?intSubscribeID='.$data['intSubscribeID']);
		}
		$this->response->redirect('subscribes.edit.php?intSubscribeID='.$data['intSubscribeID']);
	}

	function render() {
		parent::render();				
	}

}

Kernel::ProcessPage(new IndexPage("subscribes.edit.tpl"));