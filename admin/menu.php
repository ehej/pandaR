<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.MenuTable");

class IndexPage extends AdminPage {

	/**
	 * @var MenuTable
	 */
	public $menuTable;

	function index() {
		parent::index();
		
		$this->setPageTitle('Меню');
		$this->setBoldMenu('menu');
		$this->menuTable = new MenuTable($this->connection);
	}
	
	function OnDelete() {
		$this->addMessage('Меню удалено');		
		$intMenuID = $this->request->getNumber('intMenuID');		
		$this->deleteMenu($intMenuID);
		$this->response->redirect('menu.php');
	}	
	
	function OnSaveOrder() {		
		$orders = $this->request->Value('order');
		if (is_array($orders)) {
			foreach ($orders as $k => $v) {
				$i = 0;
				$ids = explode(",", $v);
				foreach ($ids as $k => $id) {
					$menu = $this->menuTable->get(array('intMenuID'=>$id));
					$menu['intSortOrder'] = $i++;
					$this->menuTable->update($menu);
				}	
			}
		}
		$this->addMessage('Порядок меню сохранен');				
	}
	
	function render() {
		parent::render();		
		
		$this->document->addValue('WELCOME_TO_UKRAINE_MENU_ID', WELCOME_TO_UKRAINE_MENU_ID);
		$this->document->addValue('HOTELS_IN_UKRAINE_MENU_ID', HOTELS_IN_UKRAINE_MENU_ID);
		$this->document->addValue('ABOUT_UKRAINE_MENU_ID', ABOUT_UKRAINE_MENU_ID);		
		$this->document->addValue('menu_list', $this->getMenuTree('top'));		
		$this->document->addValue('menu_list_bottom', $this->getMenuTree('bottom'));		
	}

	function getMenuTree($type) {
		$sort = array('intSortOrder'=>'asc');
		$data = array('intParentID' => 0, 'varTypeMenu'=> $type);
		$menu_list = $this->menuTable->GetList($data, $sort);
		if (is_array($menu_list)) {
			foreach($menu_list as $k => $v) {
				$data = array('intParentID' => $v['intMenuID']);
				$submenu_list = $this->menuTable->GetList($data, $sort);
				if ( ! empty($submenu_list)) {
					if (is_array($submenu_list)) {
						foreach($submenu_list as $ka => $va) {
							$data = array('intParentID' => $va['intMenuID']);
							$submenu_l = $this->menuTable->GetList($data, $sort);
							if ( ! empty($submenu_l)) {
								$submenu_list[$ka]['childs'] = $submenu_l;
							}
						}
					}
					$menu_list[$k]['childs'] = $submenu_list;
				}		
			}
		}
		return $menu_list;	
	}	
	
	function deleteMenu($intMenuID) {
		$submenus = $this->menuTable->getByFields(array('intParentID'=>$intMenuID), null, false);
		if (!empty($submenus)) {
			foreach ($submenus as $k => $menu) {
				$this->deleteMenu($menu['intMenuID']);
			}
		}	
		$data = array('intMenuID'=>$intMenuID);
		$this->menuTable->delete($data);					
	}
	
}

Kernel::ProcessPage(new IndexPage("menu.tpl"));