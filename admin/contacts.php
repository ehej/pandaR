<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.ContactsTable");
Kernel::Import("classes.data.ContactsContactTable");


class IndexPage extends AdminPage {

	var $ContactsTable;
	var $ContactsContactTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		$this->setPageTitle('Контакты');
		$this->setBoldMenu('contacts');
		
		$this->checkSuperAdmin();
		
		$this->ContactsTable = new ContactsTable($this->connection);
		$this->ContactsContactTable = new ContactsContactTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$this->addMessage('Контакт удален');		
		$data = array('intContactID' => $this->request->getNumber('intContactID'));		
		$this->ContactsTable->delete($data);
		$this->response->redirect('contacts.php');
	}

	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'varName');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varLogin')) && !empty($name)) $this->sfilter['LIKEvarName'] = $name;
		
		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}
	
	function render() {
		parent::render();
		
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC';	
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);

		$contacts = $this->ContactsTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		$this->document->addValue('contacts_list', $contacts);
		
		$all_contact = $this->ContactsContactTable->GetList();
		foreach ($all_contact as $value) {
			$contacts_group[$value['intContactID']][] = $value['varText'];
		}
		foreach ($contacts_group as $key => $value) {
			$contacts[$key] = implode('<br>', $value);
		}
		
		$this->document->addValue('contacts', $contacts);	
	}	
	
}

Kernel::ProcessPage(new IndexPage("contacts.tpl"));