<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.HotelsTable");

class IndexPage extends AdminPage {

	/**
	 * @var HotelsTable
	 */
	var $hotelsTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		$this->setPageTitle('Отели');
		$this->setBoldMenu('hotels');
		
		$this->hotelsTable = new HotelsTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {			
		$data = array('intHotelID' => $this->request->getNumber('intHotelID'));	
			
		$this->hotelsTable->delete($data);
		$this->response->redirect('hotels.php');
		$this->addMessage('Отель удален');	
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

		$pages = $this->hotelsTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		$this->document->addValue('hotels_list', $pages);		
	}	
	
}

Kernel::ProcessPage(new IndexPage("hotels.tpl"));