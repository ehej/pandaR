<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.AdvCountriesTable");
Kernel::Import("classes.data.AdvResortsTable");
Kernel::Import("classes.data.AdvResortsContentTable");

class IndexPage extends AdminPage {
	
	/**
	 * @var AdvCountriesTable
	 */
	var $AdvCountriesTable;
	/**
	 * @var AdvResortsTable
	 */
	var $AdvResortsTable;
	/**
	 * @var AdvResortsContentTable
	 */
	var $AdvResortsContentTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Информация о странах');
		$this->setBoldMenu('countries_catalog_adv');
		
		$this->AdvCountriesTable = new AdvCountriesTable($this->connection);
		$this->AdvResortsTable = new AdvResortsTable($this->connection);
		$this->AdvResortsContentTable = new AdvResortsContentTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$data = array('intCountryID' => $this->request->getNumber('intCountryID'));
		$flag = false;
		$resorts = $this->AdvResortsTable->GetList($data);

		
		if(count($resorts) > 0) {
			foreach($resorts  as $key => $value) {
				$hotels = $this->AdvResortsTable->GetList(array('intResortID' => $value['intResortID']));
				if(count($hotels) > 0) {
					$flag = true;
					$this->addErrorMessage('Нельзя удалить страну, т.к. с ней связанны курорты');
				}
			}
		}
		
		if($flag) {
			return;
		} else {
			$this->AdvCountriesTable->Delete($data);
			$this->addMessage('Cтрана удалена');
			$this->response->redirect('countries_catalog_adv.php');
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
		
		$tmp = array();
		$countries = $this->AdvCountriesTable->GetList($this->sfilter, null, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);
		
		foreach ($countries as $key => $value) {
			if($key == 'pager'){
				$pager = $value;
			}else{
				$value['varIdentifier'] = $value['intCountryID'];
				$value['varModule'] = 'adv_country';
				$value['link'] = LinkCreator::create($value, $this->all_alias);
				$tmp[] = $value;
			}
		}
		if(isset($pager))$tmp['pager'] = $pager;

		$countries = $tmp;	
		
		$this->document->addValue('countries_list', $countries);
		
	}

}

Kernel::ProcessPage(new IndexPage("countries_catalog_adv.tpl"));