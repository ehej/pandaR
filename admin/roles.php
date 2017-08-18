<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.RolesTable");
Kernel::Import("classes.data.UsersTable");

class IndexPage extends AdminPage {
	
	/**
	 * @var RolesTable
	 */
	var $rolesTable;
	/**
	 * @var UsersTable
	 */
	var $usersTable;

	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Роли');
		$this->setBoldMenu('roles');
		
		$this->checkSuperAdmin();
		
		$this->rolesTable = new RolesTable($this->connection);
		$this->usersTable = new UsersTable($this->connection);
		
		$this->setFilters();
	}

	function OnDelete() {		
		$intRoleID = $this->request->getNumber('intRoleID');
		$data = array('intRoleID' => $intRoleID);
		
		$users = $this->usersTable->GetList(array('intRoleID' => $intRoleID));
		if(count($users) > 0) {
			$this->addErrorMessage('Нельзя удалить роль, т.к. есть пользователи с данной ролью');
		} else {
			$this->rolesTable->delete($data);
			$this->addMessage('Роль удалена');
			$this->response->redirect('roles.php');
		}
	}

	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'varRoleName');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varRoleName')) && !empty($name)) $this->sfilter['LIKEvarRoleName'] = $name;

		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}

	function render() {
		parent::render();
		
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC';
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);
		
		$roles = $this->rolesTable->getList($this->sfilter);
		$this->document->addValue('roles_list', $roles);
	}

}

Kernel::ProcessPage(new IndexPage("roles.tpl"));