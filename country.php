<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.HotelsTable");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.StaffsTable");
Kernel::Import("classes.data.PromoTable");
Kernel::Import("classes.data.PromoHotelsTable");
Kernel::Import("classes.data.PromoHotelsDetailsTable");
Kernel::Import("classes.data.StaffsContactTable");
Kernel::Import("classes.data.StaffsRelationCoutrysTable");
Kernel::Import("classes.data.CatalogMenuTable");
Kernel::Import("classes.data.OtherInfoTable");


class IndexPage extends PublicPage {

	var $hotelsTable;
	var $regionsTable;
	var $resortsTable;
	var $StaffsTable;
	var $StaffsContactTable;
	var $StaffsRelationCoutrysTable;
	var $countriesTable;
	var $CatalogMenuTable;
	var $OtherInfoTable;
	
	var $data;
	var $curCountryID;
	var $sfilter = array();
	var $intDepadtureCityID;
	
	function index() {
		parent::index();

		$this->hotelsTable 					= new HotelsTable($this->connection);
		$this->resortsTable 				= new ResortsTable($this->connection);
		$this->regionsTable 				= new RegionsTable($this->connection);
		$this->countriesTable 				= new CountriesTable($this->connection);
		$this->StaffsTable 					= new StaffsTable($this->connection);
		$this->PromoTable 					= new PromoTable($this->connection);
		$this->PromoHotelsTable 			= new PromoHotelsTable($this->connection);
		$this->PromoHotelsDetailsTable 		= new PromoHotelDetailsTable($this->connection);
		$this->StaffsContactTable 			= new StaffsContactTable($this->connection);
		$this->StaffsRelationCoutrysTable 	= new StaffsRelationCountryTable($this->connection);		
		$this->CatalogMenuTable 			= new CatalogMenuTable($this->connection);
		$this->OtherInfoTable 				= new OtherInfoTable($this->connection);
		
		
		$intCountryID = $this->request->getNumber('intCountryID', 0);
		
		$varUrlAlias = $this->request->getString('varUrlAlias');
		if(empty($intCountryID)) {
			$intCountryID = LinkCreator::url_to_id('countries',$varUrlAlias,$this->all_alias);
		}
		
		if(!empty($intCountryID)) {
			$this->data = $this->countriesTable->Get(array('intCountryID' => $intCountryID));
			$this->setPageTitle($this->data['varMetaTitle'], $this->data['varMetaKeywords'], $this->data['varMetaDescription']);
			$this->curCountryID = $intCountryID;
		} else {
			$this->response->redirect('/');	
		}
		$this->setFilters();
	}	
	
	function setFilters() {
		$this->sfilter['isShow'] = 1;
		$this->sfilter['intCountryID'] = $this->data['intCountryID'];
		$this->intDepadtureCityID = $this->request->getNumber('intDepadtureCityID');
		if (!empty($this->intDepadtureCityID)) $this->sfilter['intDepadtureCityID'] = $this->intDepadtureCityID;
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('intDepadtureCityID', $this->intDepadtureCityID);
		$this->data['varDescription'] = $this->insertForm($this->data['varDescription']);
		$this->document->addValue('data', $this->data);

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
				'title'=>''.$this->data['varName'].'',
				'url'=>'',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);
	}
}

Kernel::ProcessPage(new IndexPage("country.tpl"));