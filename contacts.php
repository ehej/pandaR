<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.StaffsTable");
Kernel::Import("classes.data.StaffsContactTable");
Kernel::Import("classes.data.StaffsRelationCoutrysTable");
Kernel::Import("classes.data.StaffsRelationTypeTable");
Kernel::Import("classes.data.ContactsTable");
Kernel::Import("classes.data.ContactsContactTable");
Kernel::Import("classes.data.StaffsTypeTable");

Kernel::Import("classes.data.CountriesTable");

class IndexPage extends PublicPage {

	public $StaffsTable;
	public $StaffsContactTable;
	public $StaffsRelationCoutrysTable;
	public $StaffsRelationTypeTable;
	public $countriesTable;
	public $ContactsTable;
	public $ContactsContactTable;
	public $StaffsTypeTable;
	
	var $data = array();
	
	function index() {
		parent::index();

		$this->StaffsTable 					= new StaffsTable($this->connection);
		$this->StaffsContactTable 			= new StaffsContactTable($this->connection);
		$this->StaffsRelationCoutrysTable 	= new StaffsRelationCountryTable($this->connection);
		$this->StaffsRelationTypeTable 		= new StaffsRelationTypeTable($this->connection);
		$this->ContactsTable 				= new ContactsTable($this->connection);
		$this->ContactsContactTable 		= new ContactsContactTable($this->connection);
		$this->StaffsTypeTable				= new StaffsTypeTable($this->connection);
		
		$this->countriesTable = new CountriesTable($this->connection);
		$fields = $this->modulesPagesTable->GetByFields(array('varPage' => 'contact'), null, true);
		$this->setPageTitle($fields['varMetaTitle'], $fields['varMetaKeywords'], $fields['varMetaDescription']);
	}

	function render() {
		parent::render();
		
		$type = $this->StaffsTypeTable->GetList(array('isActive'=>'Yes'), array('intOrdering'=>'ASC'));
		$type_ids[] = -1;
		foreach ($type as $value) {
			$type_ids[] = $value['intTypeID'];
			$types[$value['intTypeID']] = $value;
		}
		
		$all_relation_type = $this->StaffsRelationTypeTable->GetList(array('INintTypeID'=>implode(',',$type_ids)));
		$staff_ids[] = -1;
		foreach ($all_relation_type as $value) {
			$relation_group_type[$value['intTypeID']][$value['intStaffID']] = $value['intStaffID'];
			$staff_ids[] = $value['intStaffID'];
		}

		$staffs = $this->StaffsTable->GetList(array('varView'=>"yes", 'INintStaffID'=>implode(',',$staff_ids)));	
		foreach ($staffs as $value) {
			$tmp[$value['intStaffID']] = $value;
		}
		$staffs = $tmp;
		
		$all_contact = $this->StaffsContactTable->GetList(array('INintStaffID'=>"'".implode("','",$staff_ids)."'"),  array('intContactID' => 'ASC'));
		foreach ($all_contact as $value) {
			$contact[$value['intStaffID']][] = $value;
		}
	   	$this->document->addValue('staffs', $staffs);
	   	$this->document->addValue('relations_type', $relation_group_type);
	   	$this->document->addValue('contact', $contact);
	   	$this->document->addValue('types', $types);
		
		
		$contacts_office = $this->ContactsTable->GetList(array('varView'=>'yes'), array('varMain' => 'ASC','varName'=>'ASC'));
		
		foreach ($contacts_office as $value) {
			$contact_ids[] = $value['intContactID'];
		}
		
		$all_contact_contacts = $this->ContactsContactTable->GetList(array('INintContactID'=>"'".implode("','",$contact_ids)."'"));
		foreach ($all_contact_contacts as $value) {
			$contact_contacts_group[$value['intContactID']][] = $value;
		}
		$this->document->addValue('contact_contacts_group', $contact_contacts_group);
		$this->document->addValue('contacts_office', $contacts_office);
		//------------------------
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
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);
	}
}

Kernel::ProcessPage(new IndexPage("contacts.tpl"));