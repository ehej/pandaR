<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CatalogMenuTable");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.MenuCountriesTable");
Kernel::Import("classes.data.ResortsTable");

class IndexPage extends AdminPage {

	/**
	 * @var MenuCountriesTable
	 */
	public $CatalogMenuTable;
	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	var $country;
	var $resort;
	var $type;

	function index() {
		parent::index();
		
		$this->CatalogMenuTable 	= new CatalogMenuTable($this->connection);
		$this->countriesTable 		= new CountriesTable($this->connection);
		$this->resortsTable 		= new ResortsTable($this->connection);
		$this->menuCountriesTable 	= new MenuCountriesTable($this->connection);

		$intCountryID = $this->request->getNumber('intCountryID', 0);

		if($intCountryID){
			$this->country = $this->countriesTable->Get(array('intCountryID' => $intCountryID));
			if(!empty($this->country)){
				$this->setPageTitle('Меню страны '.$this->country['varName']);
				$this->setBoldMenu('countriesCatalog');
				$this->type = 'country';
			}else{
				$this->addErrorMessage('Страны с заданным ID не найдено');		
				$this->response->redirect('countries_catalog.php');
			}
		}
	}
	
	function OnDelete() {
		$this->addMessage('Меню удалено');		
		$data['intMenuID'] = $this->request->getNumber('intMenuID');		
		$this->deleteMenu($data['intMenuID']);
		$this->response->redirect('catalog_menu.php?'.($this->type == 'country'?'intCountryID='.$this->country['intCountryID']:'intResortID='.$this->resort['intResortID']));
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
					$menu = $this->menuCountriesTable->Get(array('intMenuID' => $id));
					$menu['intSortOrder'] = $i++;
					$this->menuCountriesTable->update($menu);
				}	
			}
		}
		$this->addMessage('Порядок меню сохранен');		
		if($flagSubmenu == 'true') {
			$this->OnShowSubmenu();
		}	
		$this->response->redirect('catalog_menu.php?'.($this->type == 'country'?'intCountryID='.$this->country['intCountryID']:'intResortID='.$this->resort['intResortID']));	
	}
	
	function getMenuTree($intCountryID) {
		$sort = array('intSortOrder' => 'asc');
		$data = array('intCountryID' => $intCountryID);
		$menu_list = $this->menuCountriesTable->GetList($data, $sort);

		return $menu_list;	
	}	
	
	function deleteMenu($intMenuID) {
		$data = array('intMenuID'=>$intMenuID);
		$this->menuCountriesTable->delete($data);
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('menu_list', $this->getMenuTree($this->country['intCountryID']));
		$this->document->addValue('intParentID', $this->country['intCountryID']);
		$this->document->addValue('intCountryID', $this->country['intCountryID']);

		$this->document->addValue('type', $this->type);				
	}
}

Kernel::ProcessPage(new IndexPage("catalog_menu.tpl"));