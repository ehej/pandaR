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
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		$this->setPageTitle('Промоакции');
		$this->setBoldMenu('promo');
		
		$this->checkSuperAdmin();
		
		$this->PromoTable = new PromoTable($this->connection);
		$this->PromoHotelsTable = new PromoHotelsTable($this->connection);
		$this->PromoHotelsDetailsTable = new PromoHotelDetailsTable($this->connection);
		$this->countriesTable = new CountriesTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$this->addMessage('Промоакция удалена');		
		$data = array('intPromoID' => $this->request->getNumber('intPromoID'));		
		$this->PromoTable->delete($data);
		$this->response->redirect('promo.php');
	}

	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'varName');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varLogin')) && !empty($name)) $this->sfilter['LIKEvarName'] = $name;
		
		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}
	
	function render() {
		parent::render();
		
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC';	
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);

		$promo = $this->PromoTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		$this->document->addValue('promo_list', $promo);
		
		$all_contact = $this->PromoHotelsTable->GetList();
		foreach ($all_contact as $value) {
			$contacts_group[$value['intPromoID']][] = $value['varText'];
		}
		foreach ($contacts_group as $key => $value) {
			$contacts[$key] = implode('<br>', $value);
		}
		
		$countries = $this->countriesTable->getListIDsNames();
		$this->document->addValue('countries', $countries);	
		foreach ($countries as $value) {
			$tmp[$value['intCountryID']] = $value['varName'];
		}
		$countries = $tmp;

		$all_relation = $this->PromoHotelsDetailsTable->GetList();

		foreach ($all_relation as $value) {
			$relation_group[$value['intStaffID']][] = $countries[$value['intCountry']];
		}

		foreach ($relation_group as $key => $value) {
			$relation[$key] = implode('<br>', $value);
		}

		
		$this->document->addValue('contacts', $contacts);	
		$this->document->addValue('countries_staff', $relation);	
	}	
	
}

Kernel::ProcessPage(new IndexPage("promo.tpl"));