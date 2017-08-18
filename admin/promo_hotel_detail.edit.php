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
		$this->document->addValue('intHotelPromoID', $this->intHotelPromoID);	
		
		$this->intDetailsID = $this->request->getNumber('intDetailsID', 0);
		
		$this->checkSuperAdmin();
		
		if ($this->intDetailsID) {
			$this->setPageTitle('Редактирование деталей промоакции');
			$this->data = $this->PromoHotelsDetailsTable->Get(array('intDetailsID' => $this->intDetailsID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет деталей промоакции с заданным ID');
				$this->response->redirect('promo_hotel.edit.php?intPromoID='.$this->intPromoID.'&intHotelPromoID='.$this->intPromoHotelID);
			}
		}else{
			$this->setPageTitle('Добавление деталей промоакции');
		}
		
	}
	
	function OnSave() {
		$data['intPromoID'] 		= $this->request->getString('intPromoID');
		$data['intHotelPromoID'] 	= $this->request->getNumber('intHotelPromoID');
		
		$data['intDetailsID'] 		= $this->request->getNumber('intDetailsID', 0);
		$data['intHotelParent']		= $data['intHotelPromoID'];
		$data['varUsloviya'] 		= $this->request->getString('varUsloviya', 'NotEmpty');	
		$data['varDateFrom'] 		= date('Y-m-d',$this->request->getDate('varDateFrom'));
		$data['varDateTo'] 			= date('Y-m-d',$this->request->getDate('varDateTo'));
		$data['varTextAdd'] 		= $this->request->getString('varTextAdd');

		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			
			if (!empty($data['intDetailsID'])) {
			   	$this->PromoHotelsDetailsTable->Update($data);
			} else {
			   	$this->PromoHotelsDetailsTable->Insert($data);
			   	$data['intDetailsID'] = $this->PromoHotelsDetailsTable->getInsertId();
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intDetailsID']) && !empty($data['intDetailsID'])){
			 	$this->response->redirect('promo_hotel_detail.edit.php?intPromoID='.$data['intPromoID'].'&intHotelPromoID='.$data['intHotelPromoID'].'&intDetailsID='.$data['intDetailsID']);
			}
		}
	}
	
	function render() {
		parent::render();
		$this->document->addValue('data', $this->data);	
		$countries = $this->countriesTable->getListIDsNames();
		$this->document->addValue('countries', $countries);		
	}	
}

Kernel::ProcessPage(new IndexPage("promo_hotel_detail.edit.tpl"));