<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.GuestBookTable");

class IndexPage extends AdminPage {

	/**
	 * @var GuestBookTable
	 */
	var $GuestBookTable;
		
	var $data = false;
	
	var $intGBID;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных отзыва');
		$this->setBoldMenu('guest_book');	
			
		$this->GuestBookTable = new GuestBookTable($this->connection);	
			
		$this->intGBID = $this->request->getNumber('intGBID', 0);
		
		if ($this->intGBID) {
			$this->data = $this->GuestBookTable->Get(array('intGBID' => $this->intGBID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет отзыва с заданным ID');
				$this->response->redirect('guest_book.php');
			}
		}
	}
		
 	function OnSave() {
		$data['intGBID'] 		= $this->request->getNumber('intGBID');
		$data['varName'] 		= $this->request->getString('varName', 'NotEmpty');
		$data['varEmail'] 		= $this->request->getString('varEmail');
		$data['varSite']		= $this->request->getString('varSite');
		$data['varText'] 		= $this->request->getString('varText', 'NotEmpty');
		$data['varAnswer'] 		= $this->request->getString('varAnswer');
		$data['varDate'] 		= date('Y-m-d H:i:s', $this->request->getDate('varDate'));
		$data['intStatus'] 		= $this->request->getNumber('intStatus');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			
			if (!empty($data['intGBID'])) {
				$this->GuestBookTable->Update($data);
			} else {
				$this->GuestBookTable->Insert($data);
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intGBID']) && !empty($data['intGBID'])) $this->response->redirect('guest_book.edit.php?intGBID='.$data['intGBID']);
		}
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('data', $this->data);
	}

}

Kernel::ProcessPage(new IndexPage("guest_book.edit.tpl"));
