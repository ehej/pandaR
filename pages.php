<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.PagesTable");
Kernel::Import("classes.data.pagesToCountriesTable");

class IndexPage extends PublicPage {

	/**
	 * @var PagesTable
	 */
	var $pagesTable;
	var $pagesToCountriesTable;
	
	var $data;
	var $intMenuID;
	
	function index() {
		parent::index();
		
		$this->pagesTable = new PagesTable($this->connection);
		$this->pagesToCountriesTable = new PagesToCountriesTable($this->connection);
		
		$data['intPageID'] = $this->request->getNumber('intPageID');
		$data['intActive'] = 1;
		
		$varUrlAlias = $this->request->getString('varUrlAlias');
		if(empty($data['intPageID'])) {
			$data['intPageID'] = LinkCreator::url_to_id('pages',$varUrlAlias,$this->all_alias);
		}
		
		if(!$this->isAuthorizated) $data['intOnlyAuthorized'] = $this->isAuthorizated;
		
		$this->data = $this->pagesTable->GetByFields($data);
		
		if ($this->data['intPageID']) {
			$this->setPageTitle($this->data['varMetaTitle'], $this->data['varMetaDescription'], $this->data['varMetaKeywords']);
		} else {
			header("HTTP/1.0 404 Not Found");
			$this->setTemplate('access_denied.tpl');
		}
	}

	function getMenuTree($intParentID = WELCOME_TO_UKRAINE_MENU_ID) {
		$sort = array('intSortOrder'=>'asc'); 
		$data = array('intParentID'=>$intParentID);
		$menu_list = $this->menuTable->GetList($data, $sort);
		
		if (is_array($menu_list)) {
			foreach($menu_list as $k => $v) {
				$data = array();
				$data = array('intParentID' => $v['intMenuID']);
				$submenu_list = $this->menuTable->GetList($data, $sort);
				if ( ! empty($submenu_list)) {
					$menu_list[$k]['childs'] = $submenu_list;
				}		
			}
		}
		return $menu_list;	
	}
	
	function render() {
		parent::render();
		
		$temp = array();
		$temp = $this->menuTable->GetList(array('varModule' => 'page', 'intParentID' => $this->curMenuID));
		if (count($temp) > 0) {
			// вывод списка Welcome To Ukraine
			if ($this->curMenuID == WELCOME_TO_UKRAINE_MENU_ID || 
				$this->curMenuID == HOTELS_IN_UKRAINE_MENU_ID || 
				$this->curMenuID == ABOUT_UKRAINE_MENU_ID)
			$this->document->addValue('wtuLeftBlockFlag', true);
		}
		
		$this->document->addValue('wtus_list', $this->getMenuTree($this->curMenuID));
		
		$this->data['varDescription'] = $this->insertForm($this->data['varDescription']);
		
		$countries =  $this->pagesToCountriesTable->GetByFields(array('intPageID'=>$this->data['intPageID']));
		
		$this->curCountryID = $countries['intCountryID'];
		$this->curResortID = '';
		$this->curRegionID = '';
		$this->country = $this->countriesTable->Get(array('intCountryID' => $this->curCountryID));
		$this->curMenuName = $this->country['varName'];
		$this->addDataCountries('country');
		
		
		$this->document->addValue('data', $this->data);
		$this->breadCrumbs = array(
			array(
				'title'=>'Главная',
				'url'=>'/',
				'thisPage'=>false
			),
			array(
				'title'=>''.$this->data['varTitle'].'',
				'url'=>'',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);	
	}
}

Kernel::ProcessPage(new IndexPage("pages.tpl"));