<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.StaffsTable");
Kernel::Import("classes.data.StaffsContactTable");
Kernel::Import("classes.data.StaffsRelationCoutrysTable");
Kernel::Import("classes.data.StaffsRelationTypeTable");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.StaffsTypeTable");

class IndexPage extends AdminPage {

	public $StaffsTable;
	public $StaffsContactTable;
	public $StaffsRelationCoutrysTable;
	public $StaffsRelationTypeTable;
	public $countriesTable;
	public $StaffsTypeTable;
	public $page = 1;
	public $sfilter = array();

	function index() {
		parent::index();
		$this->setPageTitle('Сотрудники');
		$this->setBoldMenu('staffs');
		
		$this->StaffsTable 					= new StaffsTable($this->connection);
		$this->StaffsContactTable 			= new StaffsContactTable($this->connection);
		$this->StaffsRelationCoutrysTable 	= new StaffsRelationCountryTable($this->connection);
		$this->StaffsRelationTypeTable 		= new StaffsRelationTypeTable($this->connection);
		$this->countriesTable 				= new CountriesTable($this->connection);
		$this->StaffsTypeTable				= new StaffsTypeTable($this->connection);	
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$this->addMessage('Сотрудник удален');		
		$data = array('intStaffID' => $this->request->getNumber('intStaffID'));		
		$this->StaffsTable->delete($data);
		$this->response->redirect('staffs.php');
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

		$staffs = $this->StaffsTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		$staff_ids[] = -1;
		foreach ($staffs as $key => $value) {
			if($key !== 'pager'){
				$staff_ids[] = $value['intStaffID'];
			}
		}
		$this->document->addValue('staffs_list', $staffs);
		$staff_ids = array_unique($staff_ids);
		$all_contact = $this->StaffsContactTable->GetList(array('INintStaffID'=>implode(',',$staff_ids)));

		foreach ($all_contact as $value) {
			$contacts_group[$value['intStaffID']][] = $value['varText'];
		}
		foreach ($contacts_group as $key => $value) {
			$contacts[$key] = implode('<br>', $value);
		}
		
		$countries = $this->countriesTable->getListIDsNames();
		foreach ($countries as $value) {
			$tmp[$value['intCountryID']] = $value['varName'];
		}
		$countries = $tmp;

		$all_relation = $this->StaffsRelationCoutrysTable->GetList(array('INintStaffID'=>implode(',',$staff_ids)));

		foreach ($all_relation as $value) {
			$relation_group[$value['intStaffID']][] = $countries[$value['intCountry']];
		}

		foreach ($relation_group as $key => $value) {
			$relation[$key] = implode('<br>', $value);
		}
		
		$pages = $this->StaffsTypeTable->GetList(null, array('intOrdering'=>'ASC'));
		$tmp = array();
		foreach ($pages as $key => $value) {
			$tmp[$value['intTypeID']] = $value;
		}
		$type_list = $tmp;
		$this->document->addValue('type_list', $type_list);
		
		$all_relation_type = $this->StaffsRelationTypeTable->GetList(array('INintStaffID'=>implode(',',$staff_ids)));
		foreach ($all_relation_type as $value) {
			$relation_group_type[$value['intStaffID']][] = $type_list[$value['intTypeID']];
			$relation_group_type_name[$value['intStaffID']][] = $type_list[$value['intTypeID']]['varNameType'];
		}

		foreach ($relation_group_type_name as $key => $value) {
			$relation_type[$key] = implode(',<br>', $value);
		}

		
		$this->document->addValue('contacts', $contacts);	
		$this->document->addValue('countries_staff', $relation);	
		$this->document->addValue('types_staff', $relation_type);
		
	}	
	
}

Kernel::ProcessPage(new IndexPage("staffs.tpl"));