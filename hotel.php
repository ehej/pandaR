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
Kernel::Import("classes.data.PromoTable");
Kernel::Import("classes.data.PromoHotelsTable");
Kernel::Import("classes.data.PromoHotelsDetailsTable");

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
	var $PromoTable;
	var $PromoHotelsTable;
	var $PromoHotelsDetailsTable;
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
		$this->PromoTable 					= new PromoTable($this->connection);
		$this->PromoHotelsTable 			= new PromoHotelsTable($this->connection);
		$this->PromoHotelsDetailsTable 		= new PromoHotelDetailsTable($this->connection);
		
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
		
		$this->setPageTitle($this->data['varMetaTitle'], $this->data['varMetaKeywords'], $this->data['varMetaDescription']);
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('ModuleMenu', 'hotels');
		
		$country_data = $this->CountriesTable->Get(array('intCountryID'=>$this->data['intCountryID'], 'isActive'=>1));
		$country_data['varIdentifier'] = $country_data['intCountryID'];
		$country_data['varModule'] = 'country';
		$country_data['link'] = LinkCreator::create($country_data, $this->all_alias);
		$this->document->addValue('country_data', $country_data);
		
		$region_data = $this->regionsTable->Get(array('intRegionID'=>$this->data['intRegionID'], 'isActive'=>1));
		$region_data['varIdentifier'] = $region_data['intRegionID'];
		$region_data['varModule'] = 'region';
		$region_data['link'] = LinkCreator::create($region_data, $this->all_alias);
		$this->document->addValue('region_data', $region_data);
		
		$resort = $this->ResortsTable->Get(array('intResortID' => $this->data['intResortID']));
		$resort['varIdentifier'] = $resort['intResortID'];
		$resort['varModule'] = 'resort';
		$resort['link'] = LinkCreator::create($resort, $this->all_alias);
		$this->document->addValue('resort_data', $resort);
	
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->data['varDescription'] = $this->insertForm($this->data['varDescription']);
		$this->data['varDescription'] = htmlspecialchars_decode($this->data['varDescription']);
		$this->document->addValue('data', $this->data);

		$this->resort = $resort;
		$this->curCountryID = $country_data['intCountryID'];
		$this->curResortID = $resort['intResortID'];
		$this->curRegionID = $region_data['intRegionID'];
		$this->country = $country_data;
		$this->curMenuName = $this->resort['varName'];
		$this->addDataCountries();
		
		$all_cou['varIdentifier'] = $this->curCountryID;
		$all_cou['intCountryID'] = $this->curCountryID;
		$all_cou['intParentID'] = $this->curCountryID;
		$all_cou['varParentType'] = 'country';
		$all_cou['varModule'] = 'hotels';
		$all_cou['link'] = LinkCreator::create($all_cou, $this->all_alias);
		$this->document->addValue('all_cou_country', $all_cou);
		
		$all_cou['varIdentifier'] = $this->curResortID;
		$all_cou['intResortID'] = $this->curResortID;
		$all_cou['intCountryID'] = $this->curCountryID;
		$all_cou['intParentID'] = $this->curResortID;
		$all_cou['varParentType'] = 'resort';
		$all_cou['varModule'] = 'hotels';
		$all_cou['link'] = LinkCreator::create($all_cou, $this->all_alias);
		$this->document->addValue('MTCountryID', $country_data['intMTCountryID']);
		$this->document->addValue('all_cou_resort', $all_cou);

		
		
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
				'title'=>'Отели ('.$this->country['varName'].')',
				'url'=>'/hotels-country/'.$this->country['varUrlAlias'],
				'thisPage'=>false
			),
			array(
				'title'=>''.$this->data['varName'].'',
				'url'=>'',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);	
		
		
		//promoaccii
		
		$tmp = array();
		$promoaccii = $this->PromoTable->GetList(array('isActive'=>'yes', 'intCountryID'=>$this->curCountryID), array('varName'=>'ASC'));
		$arr_promo[] = -1;
		foreach ($promoaccii as $key => $value) {
			$value['varModule'] = 'promoakcii';
			$value['varIdentifier'] = $value['intPromoID'];
			$value['link'] = LinkCreator::create($value, $this->all_alias);
			$tmp[] = $value;
			$arr_promo[] = $value['intPromoID'];
		}
		$promoaccii = $tmp;
		$this->document->addValue('promoaccii_hotel_page', $promoaccii);
		
		
		$tmp = array();
		$promo_hotel_list = $this->PromoHotelsTable->GetList(array('INintParentPromo'=>"'".implode("','",$arr_promo)."'", 'intAkcent'=>1), array('varNameHotel'=>'ASC'));
		$arr_promo_hotel[] = -1;
		foreach ($promo_hotel_list as $key => $value) {
			$tmp[$value['intParentPromo']][] = $value;
			$arr_promo_hotel[] = $value['intHotelPromoID'];
		}
		$arr_promo_hotel = array_unique($arr_promo_hotel);
		$promo_hotel_list = $tmp;
		$this->document->addValue('promo_hotel_list_hotel_page', $promo_hotel_list);
		
		
		$tmp = array();
		$promo_hotel_details_list = $this->PromoHotelsDetailsTable->GetList(array('INintHotelParent'=>"'".implode("','",$arr_promo_hotel)."'"), array('varDateFrom'=>'ASC'));
		foreach ($promo_hotel_details_list as $key => $value) {
			$tmp[$value['intHotelParent']][] = $value;
		}
		$promo_hotel_details_list = $tmp;
		$this->document->addValue('promo_hotel_details_list_hotel_page', $promo_hotel_details_list);
		
		
	}
}

Kernel::ProcessPage(new IndexPage("hotel.tpl"));