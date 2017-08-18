<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.hotelsOptionTable");

class IndexPage extends AdminPage {

	/**
	 * @var hotelsOptionTable
	 */
	var $hotelsOptionTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		$this->setPageTitle('Опции отелей');
		$this->setBoldMenu('hotelsOption');
		$this->hotelsOptionTable = new hotelsOptionTable($this->connection);
		$this->setFilters();
	}
	
	function OnDelete() {
		$this->addErrorMessage('Опция удалена');		
		$data = array('intOptionID'=>$this->request->getNumber('intOptionID'));		
		$this->hotelsOptionTable->delete($data);
		$this->response->redirect('hotels_option.php');
	}

	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'intOrdering');
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

		$option_list = $this->hotelsOptionTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		
		$this->document->addValue('option_list', $option_list);		
	}	
	
}

Kernel::ProcessPage(new IndexPage("hotels_option.tpl"));
