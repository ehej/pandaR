<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.PromoTable");
Kernel::Import("classes.data.PromoHotelsTable");
Kernel::Import("classes.data.PromoHotelsDetailsTable");
Kernel::Import("classes.data.CountriesTable");

class IndexPage extends PublicPage {

	var $PromoTable;
	var $PromoHotelsTable;
	var $PromoHotelsDetailsTable;
	var $countriesTable;
	
	var $data = false;
	
	function index() {
		parent::index();
		
		$this->PromoTable = new PromoTable($this->connection);
		$this->PromoHotelsTable = new PromoHotelsTable($this->connection);
		$this->PromoHotelsDetailsTable = new PromoHotelDetailsTable($this->connection);
		
		$this->countriesTable = new CountriesTable($this->connection);
		
		$data['intPromoID'] = $this->request->getNumber('intPromoID', 0);
		$data['isActive'] = 'yes';
		if(!$this->isAuthorizated) $data['intOnlyAuthorized'] = $this->isAuthorizated;
		
		$this->data = $this->PromoTable->GetByFields($data);
		
		if ($this->data['intPromoID']) {
			$this->setPageTitle($this->data['varName'], $this->data['varMetaDescription'], $this->data['varMetaKeywords']);
		} else {
			$this->response->redirect('/');
		}
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('data', $this->data);
		$tmp = array();
		$promo_hotel_list = $this->PromoHotelsTable->GetList(array('intParentPromo'=>$this->data['intPromoID']), array('varNameHotel'=>'ASC'));
		foreach ($promo_hotel_list as $key => $value) {
			$tmp[] = $value;
			$arr_promo_hotel[] = $value['intHotelPromoID'];
		}
		$promo_hotel_list = $tmp;
		$this->document->addValue('promo_hotel_list', $promo_hotel_list);
		
		
		$tmp = array();
		$promo_hotel_details_list = $this->PromoHotelsDetailsTable->GetList(array('INintHotelParent'=>implode(',',$arr_promo_hotel)), array('varDateFrom'=>'ASC'));
		foreach ($promo_hotel_details_list as $key => $value) {
			$tmp[$value['intHotelParent']][] = $value;
		}
		$promo_hotel_details_list = $tmp;
		

		$this->curCountryID = $this->data['intCountryID'];
		$this->country = $this->countriesTable->Get(array('intCountryID' => $this->curCountryID));
		$this->curMenuName = $this->country['varName'];
		$this->addDataCountries('country');	
		
		$this->document->addValue('promo_hotel_details_list', $promo_hotel_details_list);
		$this->breadCrumbs = array(
			array(
				'title'=>'Главная',
				'url'=>'/',
				'thisPage'=>false
			),
			array(
				'title'=>'Промоакция '.$this->data['varName'].'',
				'url'=>'',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);	
	}
}

Kernel::ProcessPage(new IndexPage("promoakciya.tpl"));