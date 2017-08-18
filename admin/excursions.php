<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.ExcursionsTable");


class IndexPage extends AdminPage {
	
	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	/**
	 * @var ResortsTable
	 */
	var $resortsTable;
	/**
	 * @var RegionsTable
	 */
	var $regionsTable;
	/**
	 * @var excursionsTable
	 */
	var $excursionsTable;
	/**
	 * @var excursionsRelationTable
	 */
	var $excursionsRelationTable;
	
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Экскурсии');
		$this->setBoldMenu('excursions');
		
		$this->countriesTable = new CountriesTable($this->connection);
		$this->resortsTable = new ResortsTable($this->connection);
		$this->regionsTable = new RegionsTable($this->connection);
		$this->excursionsTable = new excursionsTable($this->connection);
		$this->excursionsRelationTable = new ExcursionsRelationTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$data = array('intExcursionID' => $this->request->getNumber('intExcursionID'));
		$this->excursionsTable->Delete($data);
		$this->excursionsRelationTable->DeleteByFields($data);
		$this->addMessage('Екскурсия удалена');
		$this->response->redirect('excursions.php');
	}
	
	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'varName');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varName')) && !empty($name)) $this->sfilter['LIKEvarName'] = $name;
		if ( ($name = $this->request->getNumber('intCountryID')) && !empty($name)) $this->sfilter['intCountryID'] = $name;

		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}

	function render() {
		parent::render();
		
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC';
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);
		
		if(isset($this->sfilter['intCountryID'])){
			$excursion_list = $this->excursionsTable->GetList($this->sfilter, $sort, null, 'getByCounry', 'getSQLRows', true, $this->page, DEFAULT_ITEMSPERPAGE);
		}else{
			$excursion_list = $this->excursionsTable->GetList($this->sfilter, $sort, null, null, 'getSQLRows', true, $this->page, DEFAULT_ITEMSPERPAGE);
		}
		foreach ($excursion_list as $key => $value) {
			if(!is_integer($key)){
				$pager = $value;
			}else{
				$value['varIdentifier'] = $value['intExcursionID'];
				$value['varModule'] = 'excursion';
				$value['link'] = LinkCreator::create($value, $this->all_alias);
				$tmp[] = $value;
				$arr_ids[] = $value['intExcursionID'];
			}
		}
		if(isset($pager))$tmp['pager'] = $pager;
		$excursion_list = $tmp;
		$arr_ids[] = -1;
		$this->document->addValue('excursion_list', $excursion_list );
		$tmp = array();
		$relation_list = $this->excursionsRelationTable->GetList(array('INintExcursionID'=>implode(',',$arr_ids)));
		foreach ($relation_list as $value) {
			$tmp[$value['varDestinationType']][] = $value;
			$tmp2[$value['intExcursionID']][$value['varDestinationType']][] = $value;
		}
		$relation_list = $tmp;
		$relation_list_excursion = $tmp2;

		
		foreach ($relation_list['country'] as $key => $value) {
		 	$country_ids[] = $value['intDestinationID'];	
		}
		$country_ids[] = -1;
		$tmp = array();
		$countries_list = $this->countriesTable->GetList(array('INintCountryID'=>implode(',',$country_ids)));
		foreach ($countries_list as $value) {
			$tmp[$value['intCountryID']] = $value;
		}
		$country_list = $tmp;
		
		
		foreach ($relation_list['resort'] as $key => $value) {
		 	$resort_ids[] = $value['intDestinationID'];	
		}
		$resort_ids[] = -1;
		$tmp = array();
		$resort_list = $this->resortsTable->GetList(array('INintResortID'=>implode(',',$resort_ids)));
		foreach ($resort_list as $value) {
			$tmp[$value['intResortID']] = $value;
		}
		$resort_list = $tmp;
		
		
		foreach ($relation_list['region'] as $key => $value) {
		 	$region_ids[] = $value['intDestinationID'];	
		}
		$region_ids[] = -1;
		$tmp = array();
		$region_list = $this->regionsTable->GetList(array('INintRegionID'=>implode(',',$region_ids)));
		foreach ($region_list as $value) {
			$tmp[$value['intRegionID']] = $value;
		}
		$region_list = $tmp;
		
		$countries_list_allsd = $this->countriesTable->GetList(null, array('varName'=>'ASC'));
		$this->document->addValue('excursion_list', $excursion_list);
		$this->document->addValue('relation_list', $relation_list);
		$this->document->addValue('relation_list_excursion', $relation_list_excursion);
		$this->document->addValue('country_list_allsd', $countries_list_allsd);
		$this->document->addValue('country_list', $country_list);
		$this->document->addValue('resort_list', $resort_list);
		$this->document->addValue('region_list', $region_list);
		
	}

}

Kernel::ProcessPage(new IndexPage("excursions.tpl"));