<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.MessagesTable");

class IndexPage extends AdminPage {

	/**
	 *
	 * @var MessagesTable
	 */
	var $messagesTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		$this->setPageTitle('Статьи рассылки');
		$this->setBoldMenu('messages');
		$this->messagesTable = new messagesTable($this->connection);
		$this->setFilters();
	}
	
	function OnDelete() {
		$this->addErrorMessage('Статья удалена');		
		$data = array('intMessageID'=>$this->request->getNumber('intMessageID'));		
		$this->messagesTable->delete($data);
		$this->response->redirect('messages.php');
	}

	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'varDate');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varSubject')) && !empty($name)) $this->sfilter['LIKEvarSubject'] = $name;
		
		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}
	
	function render() {
		parent::render();
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC';	
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);

		$pages = $this->messagesTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		$this->document->addValue('messages_list', $pages);		
	}	
	
}

Kernel::ProcessPage(new IndexPage("messages.tpl"));