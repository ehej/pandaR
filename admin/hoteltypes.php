<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.HotelsTypesTable");

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
		
		$this->setPageTitle('Типы отелей');
		$this->setBoldMenu('hoteltypes');

		
		$this->hoteltypesTable = new HotelsTypesTable($this->connection);
	}

	function OnDelete() {		
		$intRoleID = $this->request->getNumber('intHotelTypeID');
		$data = array('intHotelTypeID' => $intRoleID);

			$this->hoteltypesTable->delete($data);
			$this->addMessage('Удалено');
			$this->response->redirect('hoteltypes.php');

	}

	function OnSave() {
		$data = array('varName'=>trim($this->request->getString('varName')));
		if($data) $this->hoteltypesTable->insert($data);
		$this->response->redirect('hoteltypes.php');
	}

	function render() {
		parent::render();

		
		$roles = $this->hoteltypesTable->getList();
		$this->document->addValue('roles', $roles);
	}

}

Kernel::ProcessPage(new IndexPage("hoteltypes.tpl"));