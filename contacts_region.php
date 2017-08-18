<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.StaffsTable");
Kernel::Import("classes.data.StaffsContactTable");
Kernel::Import("classes.data.StaffsRelationCoutrysTable");
Kernel::Import("classes.data.ContactsTable");
Kernel::Import("classes.data.ContactsContactTable");

Kernel::Import("classes.data.CountriesTable");

class IndexPage extends PublicPage {

	var $StaffsTable;
	var $StaffsContactTable;
	var $StaffsRelationCoutrysTable;
	var $countriesTable;
	var $ContactsTable;
	var $ContactsContactTable;
	
	var $data = array();
	
	function index() {
		parent::index();

		$this->StaffsTable = new StaffsTable($this->connection);
		$this->StaffsContactTable = new StaffsContactTable($this->connection);
		$this->StaffsRelationCoutrysTable = new StaffsRelationCountryTable($this->connection);
		$this->ContactsTable = new ContactsTable($this->connection);
		$this->ContactsContactTable = new ContactsContactTable($this->connection);
		
		$this->countriesTable = new CountriesTable($this->connection);
		$fields = $this->modulesPagesTable->GetByFields(array('varPage' => 'contact'), null, true);
		$this->setPageTitle($fields['varMetaTitle'], $fields['varMetaKeywords'], $fields['varMetaDescription']);
	}

	function render() {
		parent::render();
		$contacts_office = $this->ContactsTable->GetList(array('NOTvarMain'=>'yes','varView'=>'yes'), array('varName'=>'ASC'));
		foreach ($contacts_office as $value) {
			$contact_ids[] = $value['intContactID'];
		}
		
		$all_contact_contacts = $this->ContactsContactTable->GetList(array('INintContactID'=>"'".implode("','",$contact_ids)."'"));
		foreach ($all_contact_contacts as $value) {
			$contact_contacts_group[$value['intContactID']][] = $value;
		}
		$this->document->addValue('contact_contacts_group', $contact_contacts_group);
			
		$tmp = array();
		$all_relation = $this->StaffsRelationCoutrysTable->GetList(array('isActive' => '1'));
		foreach ($all_relation as $value) {
			$arr_relation[$value['intCountry']][$value['intStaffID']] = $value['intStaffID'];
			$countries_ids[] = $value['intCountry'];
		}
		$countries_ids[] = -1;
		$staffs = $this->StaffsTable->GetList(array('varView'=>"yes"), array('varName'=>'ASC'));	
		$staff_id[] = -1;
		foreach ($staffs as $value) {
			$staff_id[] = $value['intStaffID'];
		}
		
		$this->document->addValue('staffs_list', $staffs);
		
		$all_contact = $this->StaffsContactTable->GetList(array('INintStaffID'=>"'".implode("','",$staff_id)."'"));
		foreach ($all_contact as $value) {
			$contacts_group[$value['intStaffID']][] = $value;
		}
		$tmp = array();
		foreach ($staffs as $value) {
			$value['contact'] = $contacts_group[$value['intStaffID']];
			$tmp[$value['intStaffID']] = $value;
		}
		$managers = $tmp;
		
		$all_country = $this->countriesTable->GetList(array('INintCountryID'=>implode(',',$countries_ids)), array('varName'=>'ASC'));
		foreach ($all_country as $value) {
			$countries[$value['intCountryID']] = $value;
		}
		$this->document->addValue('countries_contact', $countries);
		$this->document->addValue('arr_relation', $arr_relation);
		$this->document->addValue('managers_all', $managers);
		$this->document->addValue('contacts_office', $contacts_office);
		$this->document->addValue('path', FOTO_STAFFS_URL);
		$this->document->addValue('FOTO_CONTACTS_URL', FOTO_CONTACTS_URL);
		$this->breadCrumbs = array(
			array(
				'title'=>'Главная',
				'url'=>'/',
				'thisPage'=>false
			),
			array(
				'title'=>'Контакты',
				'url'=>LinkCreator::create(array('varModule'=>'contact'), $this->all_alias),
				'thisPage'=>false
			),
			array(
				'title'=>'Контакты региональнычх офисов',
				'url'=>'',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);
	}
}

Kernel::ProcessPage(new IndexPage("contacts_region.tpl"));