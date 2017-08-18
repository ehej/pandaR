<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.PromotionsTypesTable");
Kernel::Import("classes.data.SpecialOffersTable");

class IndexPage extends AdminPage {

	/**
	 * @var PromotionsTypesTable
	 */
	var $promotionsTypesTable;
	/**
	 * @var SpecialOffersTable
	 */
	var $specialOffersTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		$this->setPageTitle('Типы спецпредложений');
		$this->setBoldMenu('promotionstypes');
		
		$this->promotionsTypesTable = new PromotionsTypesTable($this->connection);
		$this->specialOffersTable = new SpecialOffersTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$data = array('intPromotionTypeID' => $this->request->getNumber('intPromotionTypeID'));	

		$so = $this->specialOffersTable->GetList($data);
		if(count($so) > 0) {
			$flag = true;
			$this->addErrorMessage('Нельзя удалить тип спецпредложения, т.к. с ним связанны записи из раздела "Спецпредложения"');
		}
		
		if($flag) {
			return;
		} else {
			$this->promotionsTypesTable->delete($data);
			$this->addMessage('Тип спецпредложения удален');	
			$this->response->redirect('promotionstypes.php');
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

		$pages = $this->promotionsTypesTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		$this->document->addValue('promotionstypes_list', $pages);		
	}	
	
}

Kernel::ProcessPage(new IndexPage("promotionstypes.tpl"));