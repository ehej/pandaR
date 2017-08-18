<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.BannersMainTable");
Kernel::Import("classes.data.BannersToModulesTable");

class IndexPage extends AdminPage {
	
	/**
	 * @var BannersMainTable
	 */
	var $bannersMainTable;
	/**
	 * @var BannersToModulesTable
	 */
	var $bannersToModulesTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Баннерные зоны');
		$this->setBoldMenu('banners_zones');
		
		$this->bannersMainTable = new BannersMainTable($this->connection);
		$this->bannersToModulesTable = new BannersToModulesTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$intBannerZoneID = $this->request->getNumber('intBannerZoneID');
		$data = array('intBannerZoneID' => $intBannerZoneID);
		$btm = $this->bannersToModulesTable->GetList($data);
		
		if(count($btm) > 0) {
			$flag = true;
			$this->addErrorMessage('Нельзя удалить баннерную зону, т.к. с ней связанны страницы');
		} 
		
		if($flag) {
			return;
		} else {
			if($intBannerZoneID == 1) {
				$this->addErrorMessage('Нельзя удалить баннерную зону по умолчанию');
			} else {
				$this->bannersMainTable->Delete($data);
				$this->addMessage('Баннерная зона удалена');
				$this->response->redirect('banners_zones.php');
			}
		}
	}
	
	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'varName');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varName')) && !empty($name)) $this->sfilter['LIKEvarName'] = $name;

		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}

	function render() {
		parent::render();
		
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC';
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);
		
		$this->document->addValue('banners_zones_list', $this->bannersMainTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE));
	}

}

Kernel::ProcessPage(new IndexPage("banners_zones.tpl"));