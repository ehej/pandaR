<?php

include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.ExcursionsTable");
Kernel::Import("classes.data.StaffsTable");
Kernel::Import("classes.data.StaffsContactTable");
Kernel::Import("classes.data.StaffsRelationCoutrysTable");
Kernel::Import("classes.data.CatalogMenuTable");


class IndexPage extends PublicPage {
	
	var $countriesTable;
	var $resortsTable;
	var $regionsTable;
	var $excursionsTable;
	var $excursionsRelationTable;
	var $StaffsTable;
	var $StaffsContactTable;
	var $StaffsRelationCoutrysTable;
	var $CatalogMenuTable;
	
	var $page = 1;
	var $sfilter = array();
	var $filter_type = array();

	function index() {
		parent::index();
		
		$this->countriesTable 				= new CountriesTable($this->connection);
		$this->resortsTable 				= new ResortsTable($this->connection);
		$this->regionsTable 				= new RegionsTable($this->connection);
		$this->excursionsTable 				= new excursionsTable($this->connection);
		$this->excursionsRelationTable 		= new ExcursionsRelationTable($this->connection);
		$this->StaffsTable					= new StaffsTable($this->connection);
		$this->StaffsContactTable 			= new StaffsContactTable($this->connection);
		$this->StaffsRelationCoutrysTable 	= new StaffsRelationCountryTable($this->connection);	
		$this->CatalogMenuTable 			= new CatalogMenuTable($this->connection);	
		

		$varDestinationType = $this->request->getString('varDestinationType');
		$intDestinationID = $this->request->getString('intDestinationID');
		if($varDestinationType == 'country'){
			$this->document->addValue('country', true);	
			$varUrlAlias = $this->request->getString('varUrlAlias');
			if(empty($intDestinationID)) {
				$intDestinationID = LinkCreator::url_to_id('countries',$varUrlAlias,$this->all_alias);
			}	
			$this->curCountryID = $intDestinationID;
		}elseif($varDestinationType == 'resort'){
			$varUrlAlias = $this->request->getString('varUrlAlias');
			if(empty($intDestinationID)) {
				$intDestinationID = LinkCreator::url_to_id('resorts',$varUrlAlias,$this->all_alias);
			}
		 	$resort = $this->resortsTable->Get(array('intResortID'=>$intDestinationID));	
		 	$this->resort = $resort;
		 	$this->curCountryID = $resort['intCountryID'];
		}
		$this->filter_type['varDestinationType'] = $varDestinationType;
		$this->filter_type['intDestinationID'] = $intDestinationID;
		if($this->filter_type['varDestinationType'] == '' || $this->filter_type['intDestinationID'] == ''){
			$this->response->redirect('/');
		}

		
		$fields = $this->modulesPagesTable->GetByFields(array('varPage' => 'excursions'), null, true);
		$this->setPageTitle($fields['varMetaTitle'], $fields['varMetaKeywords'], $fields['varMetaDescription']);
		$this->setFilters();
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
		
		
		$relation_list = $this->excursionsRelationTable->GetList($this->filter_type);
		foreach ($relation_list as $value) {
			$excurs_ids[] = $value['intExcursionID'];
		}
		$excurs_ids[] = -1;
		$this->sfilter['INintExcursionID'] = implode(',', $excurs_ids);
		$this->sfilter['isActive'] = 1;
		
		
		$excursion_list = $this->excursionsTable->GetList($this->sfilter, $sort);
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
	
		$relation_list = $this->excursionsRelationTable->GetList(array('INintExcursionID'=>implode(',',$arr_ids)));
		foreach ($relation_list as $value) {
			$tmp[$value['varDestinationType']][] = $value;
			$tmp2[$value['intExcursionID']][$value['varDestinationType']][] = $value;
		}
		$relation_list = $tmp;
		$relation_list_excursion = $tmp2;
	
		
		foreach ($relation_list['resort'] as $key => $value) {
		 	$resort_ids[] = $value['intDestinationID'];	
		}
		$resort_ids[] = -1;
		$tmp = array();
		$resort_list = $this->resortsTable->GetList(array('INintResortID'=>implode(',',$resort_ids)), array('varName'=>'ASC'));
		foreach ($resort_list as $value) {
			$tmp[$value['intResortID']] = $value;
		}
		$resort_list = $tmp;
		
	
		$this->document->addValue('excursion_list', $excursion_list);
		$this->document->addValue('relation_list', $relation_list);
		$this->document->addValue('relation_list_excursion', $relation_list_excursion);
		$this->document->addValue('resort_list', $resort_list);
		
		
		$this->curResortID = '';
		$this->curRegionID = '';
		$this->country = $this->countriesTable->Get(array('intCountryID' => $this->curCountryID));
		$this->curMenuName = $this->country['varName'];
		$this->addDataCountries('country');
		
		$this->breadCrumbs = array(
			array(
				'title'=>'Главная',
				'url'=>'/',
				'thisPage'=>false
			),
			array(
				'title'=>$this->country['varName'],
				'url'=>LinkCreator::create(array('varIdentifier'=>$this->country['intCountryID'], 'varModule'=>'country'), $this->all_alias),
				'thisPage'=>false
			)
		);
		if($this->resort){
		$this->breadCrumbs[]=array(
				'title'=>$this->resort['varName'],
				'url'=>LinkCreator::create(array('varIdentifier'=>$this->resort['intResortID'], 'varModule'=>'resort'), $this->all_alias),
				'thisPage'=>false
			);
		}
		$this->breadCrumbs[] = array(
				'title'=>'Экскурсии',
				'url'=>'',
				'thisPage'=>true
			)
		;
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);	
		
	}

}

Kernel::ProcessPage(new IndexPage("excursions.tpl"));