<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.MenuCountriesTable");
Kernel::Import("classes.data.CountriesTable");

class IndexPage extends AdminPage {

	/**
	 * @var MenuCountriesTable
	 */
	public $menuCountriesTable;
	/**
	 * @var CountriesTable
	 */
	var $countriesTable;

	function index() {
		parent::index();
		
		$this->setPageTitle('Меню стран');
		$this->setBoldMenu('menuCountries');
		
		$this->menuCountriesTable = new MenuCountriesTable($this->connection);
		$this->countriesTable = new CountriesTable($this->connection);
	}
	
	function OnShowSubmenu() {
		$intMenuID = $this->request->getNumber('intMenuID');
		$this->setPageTitle('Страны');
		$children = $this->menuCountriesTable->GetList(array('intParentID' => $intMenuID));
		$menu = $this->menuCountriesTable->Get(array('intMenuID' => $intMenuID));
		$this->document->addValue('menu_subcountries_list', $this->getMenuTree($intMenuID));
		$this->document->addValue('isSubmenu', 'true');		
		$this->document->addValue('data_menu', $menu);		
		$this->document->addValue('intMenuID', $intMenuID);		
		$this->setTemplate('menu_subcountries.tpl');
	}
	
	function OnDelete() {
		$this->addMessage('Меню удалено');		
		$intMenuID = $this->request->getNumber('intMenuID');		
		$this->deleteMenu($intMenuID);
		$this->response->redirect('menu_countries.php');
	}	
	
	function OnSaveOrder() {		
		$flagSubmenu = $this->request->getString('flagSubmenu');
		$intMenuID = $this->request->getNumber('intMenuID');
		$orders = $this->request->Value('order');
		if (is_array($orders)) {
			foreach ($orders as $k => $v) {
				$i = 0;
				$ids = explode(",", $v);
				foreach ($ids as $k => $id) {
					$menu = $this->menuCountriesTable->get(array('intMenuID' => $id));
					$menu['intSortOrder'] = $i++;
					$this->menuCountriesTable->update($menu);
				}	
			}
		}
		$this->addMessage('Порядок меню сохранен');		
		if($flagSubmenu == 'true') {
			$this->OnShowSubmenu();
		}	
		if(!empty($intMenuID)) $this->response->redirect('menu_countries.php?event=showSubmenu&intMenuID='.$intMenuID);	
		else $this->response->redirect('menu_countries.php');	
	}
	
	function render() {
		parent::render();		
		
		$this->document->addValue('menu_countries_list', $this->getMenuTree(0));
		$this->document->addValue('countries', $this->countriesTable->GetList());		
	}

	function getMenuTree($intParentID) {
		$sort = array('intSortOrder' => 'asc');
		$data = array('intParentID' => $intParentID);
		$menu_list = $this->menuCountriesTable->GetList($data, $sort);
		return $menu_list;	
	}	
	
	function deleteMenu($intMenuID) {
		$submenus = $this->menuCountriesTable->getByFields(array('intParentID' => $intMenuID), null, false);
		if (!empty($submenus)) {
			foreach ($submenus as $k => $menu) {
				$this->deleteMenu($menu['intMenuID']);
			}
		}	
		$data = array('intMenuID' => $intMenuID);
		$this->menuCountriesTable->delete($data);					
	}
	
}

Kernel::ProcessPage(new IndexPage("menu_countries.tpl"));