<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.hotelsOptionTable");

class IndexPage extends AdminPage {

	/**
	 * @var hotelsOptionTable
	 */
	var $hotelsOptionTable;	
	var $data = false;

	function index() {
		parent::index();
		$this->setPageTitle('Редактирование опции');
		$this->setBoldMenu('hotels_option');		
		$this->hotelsOptionTable = new hotelsOptionTable($this->connection);	
		$intOptionID = $this->request->getNumber('intOptionID', 0);
		if ($intOptionID) {
			$this->data = $this->hotelsOptionTable->Get(array('intOptionID'=>$intOptionID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет опции с заданным ID');
				$this->response->redirect('hotels_option.php');
			}
		}
	}

 	function OnSave() {
 		$data['intOptionID'] = $this->request->getNumber('intOptionID');
		$data['varName'] = $this->request->getString('varName', 'notEmpty');		
		$data['intOrdering'] = $this->request->getString('intOrdering');		
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if (isset($data['intOptionID']) && !empty($data['intOptionID'])) {
				$this->hotelsOptionTable->Update($data);
			} else {
				$this->hotelsOptionTable->Insert($data);
				$data['intOptionID'] = $this->hotelsOptionTable->getInsertId();
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intOptionID']) && !empty($data['intOptionID'])) $this->response->redirect('hotels_option.edit.php?intOptionID='.$data['intOptionID']);
		}
	}

	function render() {
		parent::render();				
		$this->document->addValue('data', $this->data);
	}

}

Kernel::ProcessPage(new IndexPage("hotels_option.edit.tpl"));