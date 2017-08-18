<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.StaffsTable");
Kernel::Import("classes.data.StaffsContactTable");
Kernel::Import("classes.data.StaffsRelationCoutrysTable");
Kernel::Import("classes.data.CatalogMenuTable");

class IndexPage extends PublicPage {

	var $resortsTable;
	var $regionTable;
	var $StaffsTable;
	var $StaffsContactTable;
	var $StaffsRelationCoutrysTable;
	var $CatalogMenuTable;
	
	var $data;
	
	function index() {
		parent::index();
		
		$this->resortsTable 				= new ResortsTable($this->connection);
		$this->regionsTable 				= new RegionsTable($this->connection);
		$this->StaffsTable 					= new StaffsTable($this->connection);
		$this->StaffsContactTable 			= new StaffsContactTable($this->connection);
		$this->StaffsRelationCoutrysTable 	= new StaffsRelationCountryTable($this->connection);	
		$this->CatalogMenuTable 			= new CatalogMenuTable($this->connection);	
		
		$intResortID = $this->request->getNumber('intResortID', 0);
		
		$varUrlAlias = $this->request->getString('varUrlAlias');
		if(empty($intResortID)) {
			$intResortID = LinkCreator::url_to_id('resorts',$varUrlAlias,$this->all_alias);
		}
		
		if ($intResortID) {
			$this->data = $this->resortsTable->Get(array('intResortID' => $intResortID));
			if (empty($this->data)) $this->response->redirect('/');
		}
		$tmpurl = explode('/',trim($_SERVER['REQUEST_URI'],'/'));
		if($tmpurl[0] == 'cities') {
			$country = $this->countriesTable->GetByFields(array('varUrlAlias'=>$_REQUEST['varUrlAlias']));
			$this->sfilter['intCountryID'] = $this->data['intCountryID'];
		}
		$this->setPageTitle($this->data['varMetaTitle'], $this->data['varMetaKeywords'], $this->data['varMetaDescription']);
	}
	
	function render() {
		$this->curCountryID = $this->sfilter['intCountryID'];
		parent::render();
		
		$this->document->addValue('ModuleMenu', 'resorts');
		$this->addDataCountries('country');
		$this->data['varDescription'] = $this->insertForm($this->data['varDescription']);
		$this->document->addValue('data', $this->data);
		
		$this->curResortID = $this->data['intResortID'];
		$this->country = $this->countriesTable->Get(array('intCountryID' => $this->curCountryID));
		$this->curMenuName = $this->data['varName'];

		$resort_data = $this->resortsTable->GetList(array('intCountryID' => $this->curCountryID, 'isActive'=>1));
		foreach ($resort_data as $key => $value) {
			$value['varIdentifier'] = $value['intResortID'];
			$value['varModule'] = 'resort';
			$value['link'] = LinkCreator::create($value, $this->all_alias);
			$tmp[] = $value;
		}
		$resort_data = $tmp;
		$this->document->addValue('resort_data', $resort_data);
		
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
				'title'=>'Курорти ('.$this->country['varName'].')',
				'url'=>'/cities-country/'.$this->country['varUrlAlias'],
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

Kernel::ProcessPage(new IndexPage("resort.tpl"));
