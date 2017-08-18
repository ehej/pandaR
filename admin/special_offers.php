<?php
include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.SpecialOffersTable");

class IndexPage extends AdminPage {

	/**
	 * @var SpecialOffersTable
	 */
	var $specialOffersTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Спецпредложения');
		$this->setBoldMenu('special_offers');
		$this->specialOffersTable = new SpecialOffersTable($this->connection);
		$this->setFilters();
	}
	
	function OnDelete() {
		$this->addMessage('Спецпредложение удалено');		
		$data = array('intSpecOffID' => $this->request->getNumber('intSpecOffID'));		
		$this->specialOffersTable->delete($data);
		$this->response->redirect('special_offers.php');
	}

	function OnDeleteItems() {
		$checkBoxes = $this->request->Value('cb');
		if(!empty($checkBoxes)) {
			foreach($checkBoxes as $key => $value) {
				$data = array('intSpecOffID' => $value);
				$this->specialOffersTable->Delete($data);
			}
			$this->response->redirect('special_offers.php');
			$this->addMessage('Спецпредложения удалены');	
		}
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

		$pages = $this->specialOffersTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		$this->document->addValue('special_offers_list', $pages);		
	}	
	
}

Kernel::ProcessPage(new IndexPage("special_offers.tpl"));