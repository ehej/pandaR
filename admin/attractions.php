<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.AttractionsTable");
Kernel::Import("classes.data.GallerysTable");
Kernel::Import("classes.data.GalleriesToModulesTable");
Kernel::Import("classes.data.BannersMainTable");
Kernel::Import("classes.data.BannersToModulesTable");

class IndexPage extends AdminPage {
	
	/**
	 * @var CountriesTable
	 */
	var $CountriesTable;
	/**
	 * @var ResortsTable
	 */
	var $ResortsTable;
	/**
	 * @var AttractionsTable
	 */
	var $AttractionsTable;
	
	/**
	 * @var GallerysTable
	 */
	var $gallerysTable;
	/**
	 * @var GalleriesToModulesTable
	 */
	var $galleriesToModulesTable;
	/**
	 * @var BannersToModulesTable
	 */
	var $bannersToModulesTable;
	/**
	 * @var BannersMainTable
	 */
	var $bannersMainTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Достопримечательности');
		$this->setBoldMenu('attractions');
		
		$this->CountriesTable = new CountriesTable($this->connection);
		$this->ResortsTable = new ResortsTable($this->connection);
		$this->AttractionsTable = new AttractionsTable($this->connection);
		$this->gallerysTable = new GallerysTable($this->connection);
		$this->galleriesToModulesTable = new GalleriesToModulesTable($this->connection);
		$this->bannersToModulesTable = new BannersToModulesTable($this->connection);
		$this->bannersMainTable = new BannersMainTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$data = array('intAttractionID' => $this->request->getNumber('intAttractionID'));
		$this->AttractionsTable->Delete($data);
		$this->addMessage('Достопримечательность удалена.');
		$this->response->redirect('attractions.php');
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
		$tmp = $this->CountriesTable->GetList();
		foreach($tmp as $v){
			$countries[$v['intCountryID']] = $v;
		}
		$this->document->addValue('countries_list', $countries);
		
		$all_resort = $this->ResortsTable->GetList();
		$tmp = array();
		foreach ($all_resort as $value) {
			$tmp[$value['intResortID']] = $value;
		}
		$all_resort = $tmp;
		
		$this->document->addValue('resorts_list', $all_resort);
	   
	   
	   $tmp = array();
		$data_list = $this->AttractionsTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);
		foreach ($data_list as $key => $value) {
			if(!is_integer($key)){
				$pager = $value;
			}else{
				$value['varIdentifier'] = $value['intAttractionID'];
				$value['varModule'] = 'attraction';
				$value['link'] = LinkCreator::create($value, $this->all_alias);
				$tmp[] = $value;
			}
		}
		if(isset($pager))$tmp['pager'] = $pager;

		$data_list = $tmp;	
		$this->document->addValue('data_list', $data_list);
	   
	   
		$this->document->addValue('regions_list', $resorts_content_list);
	}

}

Kernel::ProcessPage(new IndexPage("attractions.tpl"));