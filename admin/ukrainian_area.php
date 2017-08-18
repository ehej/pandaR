<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.UkrainianAreaTable");

class IndexPage extends AdminPage {
	
	/**
	 * @var UkrainianAreaTable
	 */
	var $UkrainianAreaTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Области');
		$this->setBoldMenu('ukrainian_area');
		
		$this->UkrainianAreaTable = new UkrainianAreaTable($this->connection);
		$this->setFilters();
	}
	
	function OnDelete() {
		$data = array('intAreaID' => $this->request->getNumber('intAreaID'));
		$this->UkrainianAreaTable->Delete($data);
		$this->addMessage('Область удалена');
		$this->response->redirect('ukrainian_area.php');
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
		$tmp = array();
		$data_list = $this->UkrainianAreaTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);
		$this->document->addValue('data_list', $data_list);
	}

}

Kernel::ProcessPage(new IndexPage("ukrainian_area.tpl"));