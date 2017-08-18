<?php

include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.MenuCountriesTable");
Kernel::Import("classes.data.CountriesTable");

class IndexPage extends AdminPage {

	/**
	 * @var MenuCountriesTable
	 */
	var $menuCountriesTable;
	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	
	var $data = false;

	function index() {
		parent::index();
		$this->setPageTitle('Пункт меню стран');
		$this->setBoldMenu('menuCountries');

		$this->menuCountriesTable = new MenuCountriesTable($this->connection);
		$this->countriesTable = new CountriesTable($this->connection);
		
		$intMenuID = $this->request->getNumber('intMenuID', 0);
		if ($intMenuID) {
			$this->data = $this->menuCountriesTable->Get(array('intMenuID'=>$intMenuID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет пункта с заданным ID');
				$this->response->redirect('index.php');
			}
		}
	}

	function OnSave() {		
		$data['intMenuID'] = $this->request->getNumber('intMenuID');
		$data['intParentID'] = 0;
		$data['intCountryID'] = $this->request->getNumber('intCountryID');
		$country = $this->countriesTable->Get(array('intCountryID' => $data['intCountryID']));
		$data['varTitle'] = $country['varName'];
		$data['varIdentifier'] = $this->request->getString('varIdentifier');
		$data['isCharter'] = $this->request->getNumber('isCharter');
		$data['isVisible'] = $this->request->getNumber('isVisible');
		$data['isAuthorized'] = $this->request->getNumber('isAuthorized');

		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if (isset($data['intMenuID']) && !empty($data['intMenuID'])) {
				$this->menuCountriesTable->Update($data);
			} else {
				$this->menuCountriesTable->Insert($data);
			}

			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intMenuID']) && !empty($data['intMenuID'])) $this->response->redirect('menu_countries.edit.php?intMenuID='.$data['intMenuID']);
		}
	}

	function render() {
		parent::render();
		
		$this->document->addValue('menu_countries_list', $this->getMenuTree($this->data['intMenuID']));
		$this->document->addValue('menu', $this->data);
		$this->document->addValue('countries', $this->countriesTable->GetList());
	}

	function getMenuTree($intMenuID = 0) {
		$sort = array('intSortOrder'=>'asc');
		$data = array('intParentID'=>0);
		$menu_list = $this->menuCountriesTable->GetList($data, $sort);
		if (is_array($menu_list)) {
			foreach($menu_list as $k => $v) {
				if($v['intMenuID'] == $intMenuID) {
					unset($menu_list[$k]);
					continue;
				}
			}
		}
		return $menu_list;
	}
}

Kernel::ProcessPage(new IndexPage("menu_countries.edit.tpl"));