<?php
include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.SPOEditorsTable");

class IndexPage extends AdminPage {

	/**
	 * @var SPOEditorsTable
	 */
	var $SPOEditorsTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('СПО на главной');
		$this->setBoldMenu('spoeditor');
		$this->SPOEditorsTable = new SPOEditorsTable($this->connection);
		$this->setFilters();
	}
	
	function OnDelete() {
		$this->addErrorMessage('СПО удалено');		
		$data = array('intSPOEditorID' => $this->request->getNumber('intSPOEditorID'));		
		$this->SPOEditorsTable->delete($data);
		$this->response->redirect('spoeditor.php');
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

		$pages = $this->SPOEditorsTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		$this->document->addValue('spo_editor_list', $pages);		
	}	
	
}

Kernel::ProcessPage(new IndexPage("spoeditor.tpl"));
