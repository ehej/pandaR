<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.RolesTable");

class IndexPage extends AdminPage {

	/**
	 * @var RolesTable
	 */
	var $rolesTable;
	
	var $data = false;
	var $intRoleID;
	
	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование ролей');
		$this->setBoldMenu('roles');
				
		$this->rolesTable = new RolesTable($this->connection);
			
		$this->checkSuperAdmin();
		
		$this->intRoleID = $this->request->getNumber('intRoleID', 0);
		// if($this->intRoleID == DEFAULT_SUPER_ADMIN_ID) $this->response->redirect('roles.php');
		if ($this->intRoleID) {
			$this->data = $this->rolesTable->Get(array('intRoleID' => $this->intRoleID));			
			if (empty($this->data)) {
				$this->addErrorMessage('Нет роли с заданным ID');
				$this->response->redirect('roles.php');
			}
		}
	}
		
 	function OnSave() {
		$data['varRoleName'] = $this->request->getString('varRoleName', 'NotEmpty');
		$data['intRoleID'] = $this->intRoleID;
		$data['varPriveleges'] = serialize($this->request->Value('varPriveleges'));
		
 		if ($this->request->getErrors()) {
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if (isset($data['intRoleID']) && !empty($data['intRoleID'])) {
				$this->rolesTable->Update($data);
			} else {
				$intRoleID = $this->rolesTable->Insert($data);
			}
			$this->addMessage('Данные успешно сохранены');
		}
		
		
		if (isset($data['intRoleID']) && !empty($data['intRoleID'])) $this->response->redirect('roles.edit.php?intRoleID='.$data['intRoleID']);
	}

	function render() {
		parent::render();
		
		$this->data['varPriveleges'] = unserialize($this->data['varPriveleges']);
		$this->document->addValue('data', $this->data);
	}

}

Kernel::ProcessPage(new IndexPage("roles.edit.tpl"));