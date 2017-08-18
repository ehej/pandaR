<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.PlaceTypesTable");

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
		
		$this->setPageTitle('Типы размещения');
		$this->setBoldMenu('placetypes');

		
		$this->placetypesTable = new PlaceTypesTable($this->connection);

	}

	function OnDelete() {		
		$intRoleID = $this->request->getNumber('intPlaceTypeID');
		$data = array('intPlaceTypeID' => $intRoleID);

			$this->placetypesTable->delete($data);
			$this->addMessage('Удалено');
			$this->response->redirect('placetypes.php');

	}

	function OnSave() {
		$data['varName'] = $this->request->getString('varName');
		if($data['varName']) {
			$this->placetypesTable->insert($data);
			$this->addMessage('Успешно добавлено');
		} else {
			$this->addErrorMessage('Название не может быть пустым');
		}
		
		$this->response->redirect('placetypes.php');
	}

	function render() {
		parent::render();

		
		$roles = $this->placetypesTable->getList();
		$this->document->addValue('roles', $roles);
	}

}

Kernel::ProcessPage(new IndexPage("placetypes.tpl"));