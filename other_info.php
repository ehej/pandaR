<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.OtherInfoTable");
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
	var $CatalogMenuTable;
	var $OtherInfoTable;
	var $data;
	
	function index() {
		parent::index();

		$this->OtherInfoTable 				= new OtherInfoTable($this->connection);
		$this->StaffsTable 					= new StaffsTable($this->connection);
		$this->StaffsContactTable			= new StaffsContactTable($this->connection);
		$this->StaffsRelationCoutrysTable 	= new StaffsRelationCountryTable($this->connection);
		$this->CatalogMenuTable 			= new CatalogMenuTable($this->connection);
		$this->resortsTable 				= new ResortsTable($this->connection);
		$intInfoID = $this->request->getNumber('intInfoID', 0);
		
		$varUrlAlias = $this->request->getString('varUrlAlias');
		if(empty($intInfoID)) {
			$intInfoID = LinkCreator::url_to_id('other_info',$varUrlAlias,$this->all_alias);
		}
		
		if ($intInfoID) {
			$this->data = $this->OtherInfoTable->Get(array('intInfoID' => $intInfoID));
			if (empty($this->data)) $this->response->redirect('index.php');
		}
		$this->setPageTitle($this->data['varPageTitle'],$this->data['varPageKeywords'],$this->data['varPageDescription']);
	}

	function render() {
		parent::render();
		$this->data['varContent'] = $this->insertForm($this->data['varContent']);
		$this->document->addValue('data', $this->data);
		
		$this->curCountryID = $this->data['intCountryID'];
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
			),
			array(
				'title'=>''.$this->data['varName'].'',
				'url'=>'',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);	
	}
}

Kernel::ProcessPage(new IndexPage("other_info.tpl"));