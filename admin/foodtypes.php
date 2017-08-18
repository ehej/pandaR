<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.FoodTypesTable");

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
		
		$this->setPageTitle('Типы питания');
		$this->setBoldMenu('foodtypes');

		
		$this->placetypesTable = new FoodTypesTable($this->connection);

	}

	function OnDelete() {		
		$intRoleID = $this->request->getNumber('intFoodTypeID');
		$data = array('intFoodTypeID' => $intRoleID);

			$this->placetypesTable->delete($data);
			$this->addMessage('Удалено');
			$this->response->redirect('foodtypes.php');

	}

	function OnSave() {
		$data['varName'] = $this->request->getString('varName');
		if($data['varName']) {
			$this->placetypesTable->insert($data);
			$this->addMessage('Успешно добавлено');
		} else {
			$this->addErrorMessage('Название не может быть пустым');
		}
		
		$this->response->redirect('foodtypes.php');
	}

	function render() {
		parent::render();

		
		$roles = $this->placetypesTable->getList();
		$this->document->addValue('roles', $roles);
	}

}

Kernel::ProcessPage(new IndexPage("foodtypes.tpl"));