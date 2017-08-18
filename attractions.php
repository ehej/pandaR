<?php

include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.AttractionsTable");
Kernel::Import("classes.data.StaffsTable");
Kernel::Import("classes.data.StaffsContactTable");
Kernel::Import("classes.data.StaffsRelationCoutrysTable");
Kernel::Import("classes.data.CatalogMenuTable");


class IndexPage extends PublicPage {
	
	var $countriesTable;
	var $resortsTable;
	var $regionsTable;
	var $AttractionsTable;
	var $CatalogMenuTable;

	var $StaffsTable;
	var $StaffsContactTable;
	var $StaffsRelationCoutrysTable;
	
	var $intDestinationID;
	var $varDestinationType;
	
	var $page = 1;
	var $sfilter = array();
	var $filter_type = array();

	function index() {
		parent::index();
		
		$this->countriesTable = new CountriesTable($this->connection);
		$this->resortsTable = new ResortsTable($this->connection);
		$this->regionsTable = new RegionsTable($this->connection);
		$this->AttractionsTable = new AttractionsTable($this->connection);
		$this->StaffsTable = new StaffsTable($this->connection);
		$this->StaffsContactTable = new StaffsContactTable($this->connection);
		$this->StaffsRelationCoutrysTable = new StaffsRelationCountryTable($this->connection);
		$this->CatalogMenuTable = new CatalogMenuTable($this->connection);
				

		$varDestinationType = $this->request->getString('varDestinationType');
		$intDestinationID = $this->request->getString('intDestinationID');
		if($varDestinationType == 'country'){
			$this->document->addValue('country', true);	
			$varUrlAlias = $this->request->getString('varUrlAlias');
			if(empty($intDestinationID)) {
				$intDestinationID = LinkCreator::url_to_id('countries',$varUrlAlias,$this->all_alias);
			}	
			$data_info = $this->countriesTable->Get(array('intCountryID'=>$intDestinationID));
			$this->curCountryID = $intDestinationID;
		}elseif($varDestinationType == 'resort'){
			$varUrlAlias = $this->request->getString('varUrlAlias');
			if(empty($intDestinationID)) {
				$intDestinationID = LinkCreator::url_to_id('resorts',$varUrlAlias,$this->all_alias);
			}
			$data_info = $this->resortsTable->Get(array('intResortID'=>$intDestinationID));
			$this->resort = $data_info;
			$this->curCountryID = $data_info['intCountryID'];
		}
		$this->intDestinationID = $intDestinationID;
		$this->varDestinationType = $varDestinationType;
		$this->filter_type['varDestinationType'] = $varDestinationType;
		$this->filter_type['intDestinationID'] = $intDestinationID;
		if($this->filter_type['varDestinationType'] == '' || $this->filter_type['intDestinationID'] == ''){
			$this->response->redirect('/');
		}

		
		$fields = $this->modulesPagesTable->GetByFields(array('varPage' => 'attractions'), null, true);
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
		
		if($this->varDestinationType == 'country'){
			$this->sfilter['intCountryID'] = $this->intDestinationID;	
			$this->curCountryID = $this->intDestinationID;
			$this->curResortID = '';
			$this->curRegionID = '';
			$this->country = $this->countriesTable->Get(array('intCountryID' => $this->curCountryID));
			$this->curMenuName = $this->country['varName'];
			$this->addDataCountries('country');	
		}else{
			$this->sfilter['intResortID'] = $this->intDestinationID;
			$this->curResortID = $this->intDestinationID;
			$this->resort = $this->resortsTable->Get(array('intResortID' => $this->intDestinationID));
			$this->curCountryID = $this->resort['intCountryID'];
			$this->country = $this->countriesTable->Get(array('intCountryID' => $this->curCountryID));
			$this->curMenuName = $this->resort['varName'];
			$this->addDataCountries();
		}
		$data_list = $this->AttractionsTable->GetList($this->sfilter, $sort);
		foreach ($data_list as $value) {
			$value['varIdentifier'] = $value['intAttractionID'];
			$value['varModule'] = 'attraction';
			$value['link'] = LinkCreator::create($value, $this->all_alias);
			$tmp[]= $value;
		}
		$data_list = $tmp;
		$this->document->addValue('data_list', $data_list);
		
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
				'title'=>'Достопримечательности',
				'url'=>'',
				'thisPage'=>true
			)
		;
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);
		
	}

}

Kernel::ProcessPage(new IndexPage("attractions.tpl"));
