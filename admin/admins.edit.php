<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.AdminsTable");
Kernel::Import("classes.data.RolesTable");

class IndexPage extends AdminPage {

	/**
	 * @var AdminsTable
	 */
	var $adminsTable;
	/**
	 * 
	 * @var RolesTable
	 */
	var $rolesTable;
		
	var $data = false;
	
	var $intAdminID;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных администратора');
		$this->setBoldMenu('admins');	
			
		$this->adminsTable = new AdminsTable($this->connection);	
		$this->rolesTable = new RolesTable($this->connection);
			
		$this->intAdminID = $this->request->getNumber('intAdminID', 0);
		
		$this->checkSuperAdmin();
		if($this->intAdminID == DEFAULT_SUPER_ADMIN_ID) $this->response->redirect('admins.php');
		
		if ($this->intAdminID) {
			$this->data = $this->adminsTable->Get(array('intAdminID' => $this->intAdminID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет администратора с заданным ID');
				$this->response->redirect('admins.php');
			}
		}
	}
		
 	function OnSave() {
		$data['intAdminID'] = $this->request->getNumber('intAdminID');
		$data['varLogin'] =	$this->request->getString('varLogin', 'NotEmpty');
		$data['varPassword'] =	$this->request->getString('varPassword');
		if($data['varPassword']){
			$data['varPassword'] = md5($data['varPassword']);
		}else{
			unset($data['varPassword']);
		}
		$data['varEmail'] =	$this->request->getString('varEmail', 'NotEmpty');
		$data['varFIO'] =	$this->request->getString('varFIO', 'NotEmpty');
		$data['varPhone'] =	$this->request->getString('varPhone', 'NotEmpty');
		$data['intRoleID'] = $this->request->getNumber('intRoleID', 'NotEmpty');
		$data['isActive'] =	$this->request->getNumber('isActive');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			
			if (!empty($data['intAdminID'])) {
				$this->adminsTable->Update($data);
			} else {
				$this->adminsTable->Insert($data);
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intAdminID']) && !empty($data['intAdminID'])) $this->response->redirect('admins.edit.php?intAdminID='.$data['intAdminID']);
		}
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('data', $this->data);
		$this->document->addValue('roles_list', $this->rolesTable->getList());	
	}

}

Kernel::ProcessPage(new IndexPage("admins.edit.tpl"));