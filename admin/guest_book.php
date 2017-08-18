<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.GuestBookTable");

class IndexPage extends AdminPage {

	/**
	 * @var GuestBookTable
	 */
	var $GuestBookTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		$this->setPageTitle('Гостевая книга');
		$this->setBoldMenu('guest_book');		
		$this->GuestBookTable = new GuestBookTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$this->addMessage('Отзыв удален');		
		$data = array('intGBID' => $this->request->getNumber('intGBID'));		
		$this->GuestBookTable->delete($data);
		$this->response->redirect('guest_book.php');
	}

	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'varDate');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varName')) && !empty($name)) $this->sfilter['LIKEvarName'] = $name;
		
		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}
	
	function render() {
		parent::render();
		
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'DESC' : 'ASC';	
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);

		$data_list = $this->GuestBookTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		$this->document->addValue('data_list', $data_list);
	}	
	
}

Kernel::ProcessPage(new IndexPage("guest_book.tpl"));