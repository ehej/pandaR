<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.HotelsTable");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.StaffsTable");
Kernel::Import("classes.data.StaffsContactTable");
Kernel::Import("classes.data.StaffsRelationCoutrysTable");

class IndexPage extends PublicPage {

	/**
	 * @var HotelsTable
	 */
	var $hotelsTable;
	var $ResortsTable;
	var $RegionsTable;
	var $CountriesTable;
	var $StaffsTable;
	var $StaffsContactTable;
	var $StaffsRelationCoutrysTable;
	var $intHotelID;
	var $data;
	
	function index() {
		parent::index();
		
		$this->hotelsTable 					= new HotelsTable($this->connection);
		$this->RegionsTable 				= new RegionsTable($this->connection);
		$this->ResortsTable 				= new ResortsTable($this->connection);
		$this->CountriesTable 				= new CountriesTable($this->connection);
		$this->StaffsTable 					= new StaffsTable($this->connection);
		$this->StaffsContactTable 			= new StaffsContactTable($this->connection);
		$this->StaffsRelationCoutrysTable 	= new StaffsRelationCountryTable($this->connection);
		
		$intHotelID = $this->request->getNumber('intHotelID', 0);
		
		$varUrlAlias = $this->request->getString('varUrlAlias');
		if(empty($intHotelID)) {
			$intHotelID = LinkCreator::url_to_id('hotels',$varUrlAlias,$this->all_alias);
		}
		$this->intHotelID = $intHotelID;
		if ($intHotelID) {
			$this->data = $this->hotelsTable->Get(array('intHotelID' => $intHotelID));
			if (empty($this->data)) $this->response->redirect('index.php');
		}
		
		$this->setPageTitle('Отель | '.$this->data['varName']);
	}
	
	function render() {
		parent::render();
		$this->document->addValue('data', $this->data);	
		$country_data = $this->CountriesTable->Get(array('intCountryID'=>$this->data['intCountryID'], 'isActive'=>1));
		$resort = $this->ResortsTable->Get(array('intResortID' => $this->data['intResortID'], 'isActive'=>1));
		$region_data = $this->regionsTable->Get(array('intRegionID'=>$this->data['intRegionID'], 'isActive'=>1));
		
		$this->resort = $resort;
		$this->country = $country_data;
		$this->curCountryID = $country_data['intCountryID'];
		$this->curResortID = $resort['intResortID'];
		$this->curRegionID = $region_data['intRegionID'];
		$this->curMenuName = $resort['varName'];
		$this->addDataCountries();

		// managers end
		
		
		$this->breadCrumbs = array(
			array(
				'title'=>'Главная',
				'url'=>'/',
				'thisPage'=>false
			),
			array(
				'title'=>$country_data['varName'],
				'url'=>LinkCreator::create(array('varIdentifier'=>$country_data['intCountryID'], 'varModule'=>'country'), $this->all_alias),
				'thisPage'=>false
			),
			array(
				'title'=>$resort['varName'],
				'url'=>LinkCreator::create(array('varIdentifier'=>$resort['intResortID'], 'varModule'=>'resort'), $this->all_alias),
				'thisPage'=>false
			),
			array(
				'title'=>$region_data['varName'],
				'url'=>LinkCreator::create(array('varIdentifier'=>$region_data['intRegionID'], 'varModule'=>'region'), $this->all_alias),
				'thisPage'=>false
			),
			array(
				'title'=>$this->data['varName'],
				'url'=>LinkCreator::create(array('varIdentifier'=>$this->data['intHotelID'], 'varModule'=>'hotel'), $this->all_alias),
				'thisPage'=>false
			),
			array(
				'title'=>'Фотогалерея',
				'url'=>'',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);	
	}
}

Kernel::ProcessPage(new IndexPage("hotel_gallery.tpl"));