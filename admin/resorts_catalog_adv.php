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
		
		$this->setPageTitle('Регионы');
		$this->setBoldMenu('resorts_catalog_adv');
		
		$this->AdvCountriesTable = new AdvCountriesTable($this->connection);
		$this->AdvResortsTable = new AdvResortsTable($this->connection);
		$this->AdvResortsContentTable = new AdvResortsContentTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$data = array('intResortID' => $this->request->getNumber('intResortID'));
		$contents = $this->AdvResortsContentTable->GetList($data);
		
		if(count($contents) > 0) {
			$this->addErrorMessage('Нельзя удалить курорт, т.к. есть связанные с ним достопримечательности');
		} else {
			$this->AdvResortsTable->Delete($data);
			$this->addMessage('Регион удален');
			$this->response->redirect('resorts_catalog_adv.php');
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
		$tmp = $this->AdvCountriesTable->GetList();
		foreach($tmp as $v){
			$countries[$v['intCountryID']] = $v;
		}
		$this->document->addValue('countries_list', $countries);
		
		$tmp = array();
		$resorts_list = $this->AdvResortsTable->GetList($this->sfilter, $sort, null, null, 'getSQLRows', true, $this->page, DEFAULT_ITEMSPERPAGE);
		foreach ($resorts_list as $key => $value) {
			if(!is_integer($key)){
				$pager = $value;
			}else{
				$value['varIdentifier'] = $value['intCountryID'];
				$value['varModule'] = 'adv_resort';
				$value['link'] = LinkCreator::create($value, $this->all_alias);
				$tmp[] = $value;
			}
		}
		if(isset($pager))$tmp['pager'] = $pager;

		$resorts_list = $tmp;	
		
		$this->document->addValue('resorts_list', $resorts_list);
	}

}

Kernel::ProcessPage(new IndexPage("resorts_catalog_adv.tpl"));