<?php
include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.ModulesPagesTable");

class IndexPage extends AdminPage {

	/**
	 * @var ModulesPagesTable
	 */
	var $modulesPagesTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Модульные страницы');
		$this->setBoldMenu('modulespages');
		
		$this->modulesPagesTable = new ModulesPagesTable($this->connection);
		
		$this->setFilters();
	}

	function setFilters() {
		$this->sfilter['onView'] = 'yes';
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'varTitle');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varTitle')) && !empty($name)) $this->sfilter['LIKEvarTitle'] = $name;
		
		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}
	
	function render() {
		parent::render();
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC';	
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);

		$pages = $this->modulesPagesTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		$this->document->addValue('modulespages_list', $pages);		
	}	
	
}

Kernel::ProcessPage(new IndexPage("modulespages.tpl"));
