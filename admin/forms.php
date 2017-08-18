<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.FormsTable");
Kernel::Import("classes.data.FormFieldsTable");

class IndexPage extends AdminPage {

	var $FormsTable;
	var $FormFieldsTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		$this->setPageTitle('Формы');
		$this->setBoldMenu('forms');
		
		$this->checkSuperAdmin();
		
		$this->FormsTable = new FormsTable($this->connection);
		$this->FormFieldsTable = new FormFieldsTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$this->addMessage('Форма удалена');		
		$data = array('intFormID' => $this->request->getNumber('intFormID'));		
		$this->FormsTable->delete($data);
		$this->response->redirect('forms.php');
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

		$form = $this->FormsTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		$this->document->addValue('form_list', $form);

	}	
	
}

Kernel::ProcessPage(new IndexPage("forms.tpl"));
