<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.UsersTable");

class IndexPage extends AdminPage {

	/**
	 * @var UsersTable
	 */
	var $usersTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		$this->setPageTitle('Пользователи');
		$this->setBoldMenu('users');
		
		$this->checkSuperAdmin();
		
		$this->usersTable = new UsersTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$this->addMessage('Пользователь удален');		
		$data = array('intUserID' => $this->request->getNumber('intUserID'));		
		$this->usersTable->delete($data);
		$this->response->redirect('users.php');
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

		$pages = $this->usersTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		$this->document->addValue('users_list', $pages);	
	}	
	
}

Kernel::ProcessPage(new IndexPage("users.tpl"));