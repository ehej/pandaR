<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.AdvCountriesTable");
Kernel::Import("classes.data.AdvResortsTable");
Kernel::Import("classes.data.AdvResortsContentTable");
Kernel::Import("classes.data.StaffsTable");
Kernel::Import("classes.data.StaffsContactTable");
Kernel::Import("classes.data.StaffsRelationCoutrysTable");

class IndexPage extends PublicPage {


	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	/**
	 * @var AdvCountriesTable
	 */
	var $AdvCountriesTable;
	/**
	 * @var AdvResortsTable
	 */
	var $AdvResortsTable;
	/**
	 * @var AdvResortsContentTable
	 */
	var $AdvResortsContentTable;
	var $StaffsTable;
	var $StaffsContactTable;
	var $StaffsRelationCoutrysTable;
	
	var $data;
	var $curCountryID;
	var $sfilter = array();
	var $intDepadtureCityID;
	
	function index() {
		parent::index();

		$this->countriesTable = new CountriesTable($this->connection);
		$this->AdvCountriesTable = new AdvCountriesTable($this->connection);
		$this->AdvResortsTable = new AdvResortsTable($this->connection);
		$this->AdvResortsContentTable = new AdvResortsContentTable($this->connection);
		$this->StaffsTable = new StaffsTable($this->connection);
		$this->StaffsContactTable = new StaffsContactTable($this->connection);
		$this->StaffsRelationCoutrysTable = new StaffsRelationCountryTable($this->connection);
		
		$intResortID= $this->request->getString('intResortID');
		
		$varUrlAlias = $this->request->getString('varUrlAlias');
		if(empty($intResortID)) {
			$intResortID = LinkCreator::url_to_id('AdvResorts',$varUrlAlias,$this->all_alias);
		}
		if(!empty($intResortID)) {
			$resort = $this->AdvResortsTable->Get(array('intResortID' => $intResortID));
			$this->setPageTitle($resort['varMetaTitle'], $resort['varMetaKeywords'], $resort['varMetaDescription']);
		} else {
			$fields = $this->modulesPagesTable->GetByFields(array('varPage' => 'resorts'), null, true);
			$this->setPageTitle($fields['varMetaTitle'], $fields['varMetaKeywords'], $fields['varMetaDescription']);
			$this->setPageTitle('Rehjhns');
		}
		$this->curResortID = $intResortID;
		$this->data = $resort;
		if (empty($this->data)) $this->response->redirect('/');

	}

	
	
	function render() {
		parent::render();
		
		// get special offers
		$resorts = $this->AdvResortsTable->GetList(array('intCountryID'=>$this->data['intCountryID'], 'isActive'=>1), array('intOrdering'=>'ASC'));
		foreach ($resorts as $value) {
			$value['varIdentifier'] = $this->data['intCountryID'];
			$value['varModule'] = 'adv_resort';
			$value['link'] = LinkCreator::create($value, $this->all_alias);
			if($value['intTypeBlock'] == 1){
				$info_country_block[]= $value;
			}
		}
		$resortsContent = $this->AdvResortsContentTable->GetList(array('intResortID'=>$this->data['intResortID'], 'isActive'=>1), array('intOrdering'=>'ASC'));
		
		foreach ($resortsContent as $value) {
			$value['varIdentifier'] = $this->data['intCountryID'];
			$value['varModule'] = 'adv_resort_content';
			$value['link'] = LinkCreator::create($value, $this->all_alias);
			$menu_block[]= $value;
		}
		
		$this->document->addValue('title_menu_block', 'Достопримечательности');
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('menu_block', $menu_block);
		$this->document->addValue('info_country_block', $info_country_block);
		$this->data['varContent'] = $this->insertForm($this->data['varContent']);
		$this->document->addValue('data', $this->data);
		
		
		$country = $this->AdvCountriesTable->Get(array('intCountryID' => $this->data['intCountryID']));
		$this->document->addValue('curCountryID', $country['intParentCountry']);
		$tmp = array();
		$all_relation = $this->StaffsRelationCoutrysTable->GetList(array('intCountry' => $country['intParentCountry']));
		$arr_staff_id[]='a';
		foreach ($all_relation as $value) {
			$arr_staff_id[] = $value['intStaffID'];
		}
		$arr_staff_id = array_unique($arr_staff_id);
		$arr_staff_id = array_slice($arr_staff_id, 0 ,4);
		$staffs = $this->StaffsTable->GetList(array('INintStaffID'=>"'".implode("','",$arr_staff_id)."'", 'varView'=>'yes'));	
		$this->document->addValue('staffs_list', $staffs);
		
		$all_contact = $this->StaffsContactTable->GetList(array('INintStaffID'=>"'".implode("','",$arr_staff_id)."'"));
		foreach ($all_contact as $value) {
			$contacts_group[$value['intStaffID']][] = $value;
		}
		$tmp = array();
		foreach ($staffs as $value) {
			$value['contact'] = $contacts_group[$value['intStaffID']];
			$tmp[] = $value;
		}
		$managers = $tmp;
		$this->document->addValue('managers', $managers);
		$this->document->addValue('path', FOTO_STAFFS_URL);
	}
}

Kernel::ProcessPage(new IndexPage("adv_resort.tpl"));