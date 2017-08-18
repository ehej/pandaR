<?php
include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.PromoTable");
Kernel::Import("classes.data.PromoHotelsTable");
Kernel::Import("classes.data.PromoHotelsDetailsTable");
Kernel::Import("classes.data.CountriesTable");

class IndexPage extends AdminPage {

	var $PromoTable;
	var $PromoHotelsTable;
	var $PromoHotelsDetailsTable;
	var $countriesTable;
	var $data;
	var $intPromoID;
	
	function index() {
		parent::index();
		
		$this->setBoldMenu('promo');
		
		$this->PromoTable = new PromoTable($this->connection);
		$this->PromoHotelsTable = new PromoHotelsTable($this->connection);
		$this->PromoHotelsDetailsTable = new PromoHotelDetailsTable($this->connection);
		
		$this->countriesTable = new CountriesTable($this->connection);
		
		$this->intPromoID = $this->request->getNumber('intPromoID', 0);
		$this->document->addValue('intPromoID', $this->intPromoID);	
		
		$this->intHotelPromoID = $this->request->getNumber('intHotelPromoID', 0);
		
		$this->checkSuperAdmin();
		
		if ($this->intHotelPromoID) {
			$this->setPageTitle('Редактирование отеля промоакции');
			$this->data = $this->PromoHotelsTable->Get(array('intHotelPromoID' => $this->intHotelPromoID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет отеля в промоакции с заданным ID');
				$this->response->redirect('promo.edit.php?intPromoID='.$this->intPromoID);
			}
		}else{
			$this->setPageTitle('Добавление отеля промоакции');
		}
		
	}
	
	function OnSave() {
		$data['intHotelPromoID'] 	= $this->request->getNumber('intHotelPromoID', 0);
		$data['varNameHotel'] 		= $this->request->getString('varNameHotel', 'NotEmpty');	
		$data['intAkcent'] 			= $this->request->getString('intAkcent', 0);
		$data['intParentPromo'] 	= $this->request->getString('intPromoID');
		$data['intPromoID']     	= $this->request->getString('intPromoID');
		$data['varLink']        	= $this->request->getString('varLink');
			

		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			
			if (!empty($data['intHotelPromoID'])) {
			   	$this->PromoHotelsTable->Update($data);
			} else {
			   	$this->PromoHotelsTable->Insert($data);
			   	$data['intHotelPromoID'] = $this->PromoHotelsTable->getInsertId();
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intHotelPromoID']) && !empty($data['intHotelPromoID'])) $this->response->redirect('promo_hotel.edit.php?intPromoID='.$data['intPromoID'].'&intHotelPromoID='.$data['intHotelPromoID']);
		}
	}
	
	function render() {
		parent::render();
		$this->document->addValue('data', $this->data);	
		$countries = $this->countriesTable->getListIDsNames();
		$this->document->addValue('countries', $countries);
		
		$promo_hotel_details_list = $this->PromoHotelsDetailsTable->GetList(array('intHotelParent'=>$this->data['intHotelPromoID']));
		$this->document->addValue('promo_hotel_details_list', $promo_hotel_details_list);
		
	}	
}

Kernel::ProcessPage(new IndexPage("promo_hotel.edit.tpl"));