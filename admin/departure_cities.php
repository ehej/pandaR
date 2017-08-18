<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.DepartureCitiesTable");
Kernel::Import("classes.data.WhereBuyTable");
Kernel::Import("classes.data.SPOEditorsTable");
Kernel::Import("classes.data.SpecialOffersTable");

class IndexPage extends AdminPage {
	/**
	 * @var RegionsTable
	 */
	var $regionsTable;
	/**
	 * @var DepartureCitiesTable
	 */
	var $departureCitiesTable;
	/**
	 * @var WhereBuyTable
	 */
	var $whereBuyTable;
	/**
	 * @var SPOEditorsTable
	 */
	var $SPOEditorsTable;
	/**
	 * @var SpecialOffersTable
	 */
	var $specialOffersTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Города вылета');
		$this->setBoldMenu('departure_cities');
		
		$this->departureCitiesTable = new DepartureCitiesTable($this->connection);
		$this->regionsTable = new RegionsTable($this->connection);
		$this->whereBuyTable = new WhereBuyTable($this->connection);
		$this->SPOEditorsTable = new SPOEditorsTable($this->connection);
		$this->specialOffersTable = new SpecialOffersTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$data = array('intDepadtureCityID' => $this->request->getNumber('intDepadtureCityID'));
		
		$wb = $this->whereBuyTable->GetList($data);
		if(count($wb) > 0) {
			$flag = true;
			$this->addErrorMessage('Нельзя удалить город вылета, т.к. с ним связанны записи из раздела "Где купить"');
		}
		
		$spo = $this->SPOEditorsTable->GetList($data);
		if(count($spo) > 0) {
			$flag = true;
			$this->addErrorMessage('Нельзя удалить город вылета, т.к. с ним связанны записи из раздела "СПО на главной"');
		}
		
		$so = $this->specialOffersTable->GetList($data);
		if(count($so) > 0) {
			$flag = true;
			$this->addErrorMessage('Нельзя удалить город вылета, т.к. с ним связанны записи из раздела "Спецпредложения"');
		}
		
		if($flag) {
			return;
		} else {
			$this->departureCitiesTable->Delete($data);
			$this->addMessage('Город вылета удален');
			$this->response->redirect('departure_cities.php');
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
		$this->document->addValue('regions_list', $this->regionsTable->GetList());
		$this->document->addValue('departure_cities_list', $this->departureCitiesTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE));
	}

}

Kernel::ProcessPage(new IndexPage("departure_cities.tpl"));