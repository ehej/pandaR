<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

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
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		$this->setPageTitle('Администраторы');
		$this->setBoldMenu('admins');
		
		$this->checkSuperAdmin();
		
		$this->adminsTable = new AdminsTable($this->connection);
		$this->rolesTable = new RolesTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$this->addMessage('Администратор удален');		
		$data = array('intAdminID' => $this->request->getNumber('intAdminID'));		
		$this->adminsTable->delete($data);
		$this->response->redirect('admins.php');
	}

	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'varLogin');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varLogin')) && !empty($name)) $this->sfilter['LIKEvarLogin'] = $name;
		
		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}
	
	function render() {
		parent::render();
		
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC';	
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);

		$admins = $this->adminsTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		$this->document->addValue('admins_list', $admins);
		$this->document->addValue('roles_list', $this->rolesTable->getList());	
	}	
	
}

Kernel::ProcessPage(new IndexPage("admins.tpl"));