<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.ToursTable");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.RegionsTable");


class IndexPage extends AdminPage {

	var $toursTable;
	var $countriesTable;
	var $regionsTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		$this->setPageTitle('Туры');
		$this->setBoldMenu('tours');
		$this->toursTable = new toursTable($this->connection);
		$this->countriesTable = new CountriesTable($this->connection);
		$this->regionsTable = new RegionsTable($this->connection);
		$this->setFilters();
	}
	
	function OnDelete() {
		$this->addErrorMessage('Тур удален');		
		$data = array('intTourID'=>$this->request->getNumber('intTourID'));		
		$this->toursTable->delete($data);
		$this->response->redirect('tours.php');
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
		$pages = $this->toursTable->GetList($this->sfilter, $sort, null, 'GetListWithNames', 'getSQLRows', true, $this->page, DEFAULT_ITEMSPERPAGE);
		$this->document->addValue('tours_list', $pages);		
	}	
	
}

Kernel::ProcessPage(new IndexPage("tours.tpl"));