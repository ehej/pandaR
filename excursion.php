<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");

Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.CatalogMenuTable");

Kernel::Import("classes.data.ExcursionsTable");

Kernel::Import("classes.data.StaffsTable");
Kernel::Import("classes.data.StaffsContactTable");
Kernel::Import("classes.data.StaffsRelationCoutrysTable");

class IndexPage extends PublicPage {

	var $countriesTable;
	var $regionsTable;
	var $resortsTable;
	var $excursionsTable;
	var $excursionsRelationTable;
	var $CatalogMenuTable;
	
	var $StaffsTable;
	var $StaffsContactTable;
	var $StaffsRelationCoutrysTable;

	
	var $data = false;

	function index() {
		parent::index();

		$this->excursionsTable 				= new ExcursionsTable($this->connection);
		$this->excursionsRelationTable 		= new ExcursionsRelationTable($this->connection);
		
		$this->countriesTable 				= new CountriesTable($this->connection);
		$this->resortsTable 				= new ResortsTable($this->connection);
		$this->regionsTable 				= new RegionsTable($this->connection);
		$this->CatalogMenuTable 			= new CatalogMenuTable($this->connection);
		$this->StaffsTable 					= new StaffsTable($this->connection);
		$this->StaffsContactTable 			= new StaffsContactTable($this->connection);
		$this->StaffsRelationCoutrysTable 	= new StaffsRelationCountryTable($this->connection);		

		
		$intExcursionID = $this->request->getNumber('intExcursionID', 0);
		if ($intExcursionID) {
			$this->data = $this->excursionsTable->Get(array('intExcursionID' => $intExcursionID));
			if (empty($this->data)) {
				$this->response->redirect('excursions.php');
			}
		}
		$this->setPageTitle('Экскурсия '.$this->data['varName']);
	}	
	
	function render() {
		parent::render();
		
		$relation_list = $this->excursionsRelationTable->GetList(array('intExcursionID'=>$this->data['intExcursionID']));
		foreach ($relation_list as $value) {
			if($value['varDestinationType'] == 'country'){
				$country_now = $value;
			}
			$tmp[$value['varDestinationType']][$value['intDestinationID']] = $value;
		}
		$relation_list = $tmp;
		
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
		
		$this->document->addValue('data', $this->data);	
		$this->document->addValue('relation_list', $relation_list);
		$this->document->addValue('country_list', $country_list);
		$this->document->addValue('resort_list', $resort_list);
		$this->document->addValue('region_list', $region_list);
		
		$this->curCountryID = $country_now['intDestinationID'];
		$this->curResortID = '';
		$this->curRegionID = '';
		$this->country = $this->countriesTable->Get(array('intCountryID' => $this->curCountryID));
		$this->curMenuName = $this->country['varName'];
		$this->addDataCountries('country');
		
		$id_ex = $this->excursionsTable->getIDExc($country_now['intDestinationID']);
		foreach ($id_ex as $key => $value) {
			if($id_ex[$key]['intExcursionID'] === $this->data['intExcursionID']){
				$prew_id = $id_ex[$key-1]['intExcursionID'];
				$next_id = $id_ex[$key+1]['intExcursionID'];
			}
		}
		if($prew_id){
			$prew= $this->excursionsTable->Get(array('intExcursionID' => $prew_id));
			$prew['varIdentifier'] = $prew['intExcursionID'];
			$prew['varModule'] = 'excursion';
			$prew['link'] = LinkCreator::create($prew, $this->all_alias);		
			$this->document->addValue('prew', $prew);
		}
		if($next_id){
			$next= $this->excursionsTable->Get(array('intExcursionID' => $next_id));	
			$next['varIdentifier'] = $next['intExcursionID'];
			$next['varModule'] = 'excursion';
			$next['link'] = LinkCreator::create($next, $this->all_alias);	
			$this->document->addValue('next', $next);
		}
		
		$all_cou['varIdentifier'] = $country_now['intDestinationID'];
		$all_cou['intCountryID'] = $country_now['intDestinationID'];
		$all_cou['intParentID'] = $country_now['intDestinationID'];
		$all_cou['varParentType'] = 'country';
		$all_cou['varModule'] = 'excursions';
		$all_cou['link'] = LinkCreator::create($all_cou, $this->all_alias);
		$this->document->addValue('all_cou', $all_cou);

		$this->document->addValue('metatitle', $this->data['varMetaTitle']);
		$this->document->addValue('metadescription', $this->data['varMetaDescription']);
		$this->document->addValue('metakeywords', $this->data['varMetaKeywords']);
		
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
			),
			array(
				'title'=>'Экскурсии',
				'url'=>'',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);

	}

}

Kernel::ProcessPage(new IndexPage("excursion.tpl"));