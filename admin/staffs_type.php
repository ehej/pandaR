<?php
include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.StaffsTypeTable");

class IndexPage extends AdminPage {

	/**
	 *
	 * @var StaffsTypeTable
	 */
	var $StaffsTypeTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Категории контактов');
		$this->setBoldMenu('staffs_type');
		
		$this->StaffsTypeTable = new StaffsTypeTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$this->addErrorMessage('Категория удалена');		
		$data = array('intTypeID' => $this->request->getNumber('intTypeID'));		
		$this->StaffsTypeTable->delete($data);
		$this->response->redirect('staffs_type.php');
	}

	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'intOrdering');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varNameType')) && !empty($name)) $this->sfilter['LIKEvarNameType'] = $name;
		
		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}
	
	function render() {
		parent::render();
		
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC' ;	
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);

		$pages = $this->StaffsTypeTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);
		$this->document->addValue('type_list', $pages);		
	}	
	
}

Kernel::ProcessPage(new IndexPage("staffs_type.tpl"));
