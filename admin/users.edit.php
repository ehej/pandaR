<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.UsersTable");

class IndexPage extends AdminPage {

	/**
	 * @var UsersTable
	 */
	var $usersTable;
		
	var $data = false;
	
	var $intUserID;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных пользователя');
		$this->setBoldMenu('users');	
			
		$this->usersTable = new UsersTable($this->connection);
			
		$this->intUserID = $this->request->getNumber('intUserID', 0);
		if ($this->intUserID) {
			$this->data = $this->usersTable->Get(array('intUserID' => $this->intUserID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет пользователя с заданным ID');
				$this->response->redirect('users.php');
			}
		}
	}
		
 	function OnSave() {
		$data['intUserID'] = $this->request->getNumber('intUserID');
		$data['varName'] = $this->request->getString('varName', 'NotEmpty');
		$data['varOwnership'] = $this->request->getString('varOwnership', 'NotEmpty');
		$data['varEGRPO'] = $this->request->getString('varEGRPO', 'NotEmpty');
		$data['varUrName'] = $this->request->getString('varUrName', 'NotEmpty');
		$data['varBankGuarantee'] = $this->request->getString('varBankGuarantee', 'NotEmpty');
		$data['varTels'] = $this->request->getString('varTels', 'NotEmpty');
		$data['varFax'] = $this->request->getString('varFax', 'NotEmpty');
		$data['varEmail'] = $this->request->getString('varEmail', 'NotEmpty');
		$data['varUrIndex'] = $this->request->getString('varUrIndex', 'NotEmpty');
		$data['varUrCity'] = $this->request->getString('varUrCity', 'NotEmpty');
		$data['varUrAddress'] = $this->request->getString('varUrAddress', 'NotEmpty');
		$data['varFizIndex'] = $this->request->getString('varFizIndex', 'NotEmpty');
		$data['varFizCity'] = $this->request->getString('varFizCity', 'NotEmpty');
		$data['varFizAddress'] = $this->request->getString('varFizAddress', 'NotEmpty');
		$data['varFIO'] = $this->request->getString('varFIO', 'NotEmpty');
		$data['isActive'] =	$this->request->getNumber('isActive');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			
			if (!empty($data['intUserID'])) {
				$this->usersTable->Update($data);
			} else {
				$this->usersTable->Insert($data);
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intUserID']) && !empty($data['intUserID'])) $this->response->redirect('users.edit.php?intUserID='.$data['intUserID']);
		}
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('data', $this->data);	
	}

}

Kernel::ProcessPage(new IndexPage("users.edit.tpl"));