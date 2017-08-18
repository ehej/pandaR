<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.HotelsTable");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.StaffsTable");
Kernel::Import("classes.data.StaffsContactTable");
Kernel::Import("classes.data.StaffsRelationCoutrysTable");

class IndexPage extends PublicPage {

	/**
	 * @var HotelsTable
	 */
	var $hotelsTable;
	/**
	 * @var RegionsTable
	 */
	var $regionsTable;
	var $resortsTable;
	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	var $StaffsTable;
	var $StaffsContactTable;
	var $StaffsRelationCoutrysTable;
	
	var $data = false;
	var $country;
	
	function index() {
		parent::index();

		$this->hotelsTable = new HotelsTable($this->connection);
		$this->regionsTable = new RegionsTable($this->connection);
		$this->resortsTable = new ResortsTable($this->connection);
		$this->countriesTable = new CountriesTable($this->connection);
		$this->StaffsTable = new StaffsTable($this->connection);
		$this->StaffsContactTable = new StaffsContactTable($this->connection);
		$this->StaffsRelationCoutrysTable = new StaffsRelationCountryTable($this->connection);

		$intCountryID = $this->request->getNumber('intCountryID', 0);
		
		$varUrlAlias = $this->request->getString('varUrlAlias');
		if(empty($intCountryID)) {
			$intCountryID = LinkCreator::url_to_id('countries',$varUrlAlias,$this->all_alias);
		}
		
		$this->country = $this->countriesTable->Get(array('intCountryID' => $intCountryID));
		if ($intCountryID) {
			if (empty($this->country)) {
				$this->response->redirect('index.php');
			}
		}

		$tmpurl = explode('/',trim($_SERVER['REQUEST_URI'],'/'));
		if($tmpurl[0] == 'regions-country') {
			$country = $this->countriesTable->GetByFields(array('varUrlAlias'=>$_REQUEST['varUrlAlias']));
			$this->sfilter['intCountryID'] = $country['intCountryID'];
		}
		$this->setPageTitle('Отели | '.$this->country['varName'], $this->country['varMetaKeywords'], $this->country['varMetaDescription']);
	}

	function render() {
		$this->curCountryID = $this->sfilter['intCountryID'];
		parent::render();
		
		
		$rel = $this->AdvCountriesTable->GetByFields(array('intParentCountry' => $this->curCountryID));
		$this->document->addValue('relation', $rel);
		
		$resort = $this->resortsTable->GetList(array('intCountryID'=>$this->curCountryID, 'isActive'=>1));
		foreach ($resort as $value) {
			$value['varIdentifier'] = $value['intResortID'];
			$value['varModule'] = 'resorts';
			$value['link'] = LinkCreator::create($value, $this->all_alias);
			$tmp[$value['intResortID']] = $value;
			$arr_resort_id[] = $value['intResortID'];
		}
		$resort = $tmp;
		$tmp = array();
		$region = $this->regionsTable->GetList(array('INintResortID'=>implode(',',$arr_resort_id), 'isActive'=>1));
		foreach ($region as $value) {
			$value['varIdentifier'] = $value['intRegionID'];
			$value['varModule'] = 'region';
			$value['link'] = LinkCreator::create($value, $this->all_alias);
			$tmp[] = $value;
			$arr_region_id[] = $value['intRegionID'];
		}
		$region = $tmp;

		
		$this->data['country'] = $this->country;
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('resort', $resort);	
		$this->document->addValue('region', $region);	
		
		$this->document->addValue('data', $this->data);	
		//$this->document->addValue('curCountryID', $this->data['intCountryID']);
		$tmp = array();
		$all_relation = $this->StaffsRelationCoutrysTable->GetList(array('intCountry' => $this->data['intCountryID']));
		$arr_staff_id[] = 'a';
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

Kernel::ProcessPage(new IndexPage("regions.tpl"));