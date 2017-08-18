<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.UkrainianCityTable");

class IndexPage extends AdminPage {
	
	/**
	 * @var UkrainianCityTable
	 */
	var $UkrainianCityTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Города');
		$this->setBoldMenu('ukrainian_city');
		
		$this->UkrainianCityTable = new UkrainianCityTable($this->connection);
		$this->setFilters();
	}
	
	function OnDelete() {
		$data = array('intCityID' => $this->request->getNumber('intCityID'));
		$this->UkrainianCityTable->Delete($data);
		$this->addMessage('Область удалена');
		$this->response->redirect('ukrainian_сity.php');
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
		$data_list = $this->UkrainianCityTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);
		$this->document->addValue('data_list', $data_list);
	}

}

Kernel::ProcessPage(new IndexPage("ukrainian_city.tpl"));