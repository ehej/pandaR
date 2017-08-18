<?php
include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.AkciiTable");

class IndexPage extends AdminPage {

	/**
	 *
	 * @var akciiTable
	 */
	var $akciiTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Акции');
		$this->setBoldMenu('akcii');
		
		$this->akciiTable = new AkciiTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$this->addErrorMessage('Акция удалена');		
		$data = array('intAkciyID' => $this->request->getNumber('intAkciyID'));		
		$this->akciiTable->delete($data);
		$this->response->redirect('akcii.php');
	}

	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'varTitle');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varTitle')) && !empty($name)) $this->sfilter['LIKEvarTitle'] = $name;
		
		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}
	
	function render() {
		parent::render();
		
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC';	
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);

		$pages = $this->akciiTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);
		$tmp = array();
		foreach ($pages as $key => $value) {
			if(!is_integer($key)){
				$pager = $value;
			}else{
				$value['varIdentifier'] = $value['intAkciyID'];
				$value['varModule'] = 'akciya';
				$value['link'] = LinkCreator::create($value, $this->all_alias);
				$tmp[] = $value;
			}
		}
		if(isset($pager))$tmp['pager'] = $pager;
		$pages = $tmp;	
		
		$this->document->addValue('akcii_list', $pages);		
	}	
	
}

Kernel::ProcessPage(new IndexPage("akcii.tpl"));
