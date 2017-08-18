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
	
	function index() {
		parent::index();
		
		$this->setBoldMenu('promo');
		
		$this->PromoTable = new PromoTable($this->connection);
		$this->PromoHotelsTable = new PromoHotelsTable($this->connection);
		$this->PromoHotelsDetailsTable = new PromoHotelDetailsTable($this->connection);
		
		$this->countriesTable = new CountriesTable($this->connection);
		
		$this->intPromoID = $this->request->getNumber('intPromoID', 0);
		
		$this->checkSuperAdmin();
		
		if ($this->intPromoID) {
			$this->setPageTitle('Редактирование промоакции');
			$this->data = $this->PromoTable->Get(array('intPromoID' => $this->intPromoID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет промоакции с заданным ID');
				$this->response->redirect('promo.php');
			}
		}else{
			$this->setPageTitle('Добавление промоакции');
		}
		
	}
	
	function OnSave() {
		$data['intPromoID'] 	= $this->request->getNumber('intPromoID', 0);
		$data['varName'] 		= $this->request->getString('varName', 'NotEmpty');	
		$data['varHead'] 		= $this->request->getString('varHead');	
		$data['varFoot'] 		= $this->request->getString('varFoot');
		$data['isActive'] 		= $this->request->getString('isActive');
		$data['intCountryID'] 	= $this->request->getNumber('intCountryID');

		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			
			if (!empty($data['intPromoID'])) {
			   	$this->PromoTable->Update($data);
			} else {
			   	$this->PromoTable->Insert($data);
			   	$data['intPromoID'] = $this->PromoTable->getInsertId();
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intPromoID']) && !empty($data['intPromoID'])) $this->response->redirect('promo.edit.php?intPromoID='.$data['intPromoID']);
		}
	}
	
	function render() {
		parent::render();
		$this->document->addValue('data', $this->data);	
		$countries = $this->countriesTable->getListIDsNames();
		$this->document->addValue('countries', $countries);
		
		$promo_hotel_list = $this->PromoHotelsTable->GetList(array('intParentPromo'=>$this->data['intPromoID']));
		$this->document->addValue('promo_hotel_list', $promo_hotel_list);
		
	}	
}

Kernel::ProcessPage(new IndexPage("promo.edit.tpl"));