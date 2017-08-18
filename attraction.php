<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.AttractionsTable");
Kernel::Import("classes.data.StaffsTable");
Kernel::Import("classes.data.StaffsContactTable");
Kernel::Import("classes.data.StaffsRelationCoutrysTable");
Kernel::Import("classes.data.CatalogMenuTable");
Kernel::Import("classes.data.ResortsTable");


class IndexPage extends PublicPage {

	var $StaffsTable;
	var $StaffsContactTable;
	var $StaffsRelationCoutrysTable;
	var $resortsTable;
	var $AttractionsTable;
	var $CatalogMenuTable;
	var $data;
	
	function index() {
		parent::index();

		$this->AttractionsTable				= new AttractionsTable($this->connection);
		$this->StaffsTable 					= new StaffsTable($this->connection);
		$this->StaffsContactTable			= new StaffsContactTable($this->connection);
		$this->StaffsRelationCoutrysTable 	= new StaffsRelationCountryTable($this->connection);
		$this->CatalogMenuTable 			= new CatalogMenuTable($this->connection);
		$this->resortsTable 				= new ResortsTable($this->connection);
		
		$intAttractionID = $this->request->getNumber('intAttractionID', 0);
		
		$varUrlAlias = $this->request->getString('varUrlAlias');
		if(empty($intAttractionID)) {
			$intAttractionID = LinkCreator::url_to_id('attractions',$varUrlAlias,$this->all_alias);
		}
		
		if ($intAttractionID) {
			$this->data = $this->AttractionsTable->Get(array('intAttractionID' => $intAttractionID));
			if (empty($this->data)) $this->response->redirect('index.php');
		}
		$this->setPageTitle($this->data['varPageTitle'],$this->data['varPageKeywords'],$this->data['varPageDescription']);
	}

	function render() {
		parent::render();
		$this->data['varContent'] = $this->insertForm($this->data['varContent']);
		$this->document->addValue('data', $this->data);
		$this->curCountryID = $this->data['intCountryID'];
		
		$this->curCountryID = $this->data['intCountryID'];
		$this->curResortID = '';
		$this->curRegionID = '';
		$this->country = $this->countriesTable->Get(array('intCountryID' => $this->curCountryID));
		$this->curMenuName = $this->country['varName'];
		$this->addDataCountries('country');
		
		$id_ex = $this->AttractionsTable->getIDAttr($this->curCountryID);
		foreach ($id_ex as $key => $value) {
			if($id_ex[$key]['intAttractionID'] === $this->data['intAttractionID']){
				$prew_id = $id_ex[$key-1]['intAttractionID'];
				$next_id = $id_ex[$key+1]['intAttractionID'];
			}
		}
		if($prew_id){
			$prew= $this->AttractionsTable->Get(array('intAttractionID' => $prew_id));
			$prew['varIdentifier'] = $prew['intAttractionID'];
			$prew['varModule'] = 'attraction';
			$prew['link'] = LinkCreator::create($prew, $this->all_alias);		
			$this->document->addValue('prew', $prew);
		}
		if($next_id){
			$next= $this->AttractionsTable->Get(array('intAttractionID' => $next_id));	
			$next['varIdentifier'] = $next['intAttractionID'];
			$next['varModule'] = 'attraction';
			$next['link'] = LinkCreator::create($next, $this->all_alias);	
			$this->document->addValue('next', $next);
		}
		
		$all_cou['varIdentifier'] = $this->curCountryID;
		$all_cou['intCountryID'] = $this->curCountryID;
		$all_cou['intParentID'] = $this->curCountryID;
		$all_cou['varParentType'] = 'country';
		$all_cou['varModule'] = 'attractions';
		$all_cou['link'] = LinkCreator::create($all_cou, $this->all_alias);
		$this->document->addValue('all_cou', $all_cou);
		
		
		
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
		$this->breadCrumbs[] = array(
				'title'=>''.$this->data['varName'].'',
				'url'=>'',
				'thisPage'=>true
			)
		;
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);
		
	}
}

Kernel::ProcessPage(new IndexPage("attraction.tpl"));