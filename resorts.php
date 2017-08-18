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
	
	var $data = false;
	var $country;
	var $StaffsTable;
	var $StaffsContactTable;
	var $StaffsRelationCoutrysTable;
	
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
			$intResortID = LinkCreator::url_to_id('resorts',$varUrlAlias,$this->all_alias);
		}
		$tmpurl = explode('/',trim($_SERVER['REQUEST_URI'],'/'));
		if($tmpurl[0] == 'cities-country') {
			$country = $this->countriesTable->GetByFields(array('varUrlAlias'=>$_REQUEST['varUrlAlias']));

			$this->curCountryID = $this->sfilter['intCountryID'] = $country['intCountryID'];
		}

		$this->resort = $this->resortsTable->Get(array('intResortID' => $intResortID));
		if ($intResortID) {
			if (empty($this->resort)) {
				$this->response->redirect('index.php');
			}
		}
		$this->setPageTitle('Курорты | '.$this->resort['varName'], $this->resort['varMetaKeywords'], $this->resort['varMetaDescription']);
	}

	function render() {
		$this->curCountryID = $this->sfilter['intCountryID'];
		parent::render();
		$this->addDataCountries('country');
		$this->data['resort'] = $this->resort;
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('resort', $resort);	
		$this->document->addValue('data', $this->data);
	
		$tmp = array();
		$resort_data = $this->resortsTable->GetList(array('intCountryID' => $this->curCountryID, 'isActive'=>1));
		foreach ($resort_data as $key => $value) {
			$value['varIdentifier'] = $value['intResortID'];
			$value['varModule'] = 'resort';
			$value['link'] = LinkCreator::create($value, $this->all_alias);
			$tmp[] = $value;
		}
		$resort_data = $tmp;
		$this->document->addValue('resort_data', $resort_data);
		
		$this->curResortID = $this->data['intResortID'];
		$this->country = $this->countriesTable->Get(array('intCountryID' => $this->curCountryID));
		$this->curMenuName = $this->data['varName'];
		
		$this->breadCrumbs = array(
			array(
				'title'=>'Главная',
				'url'=>'/',
				'thisPage'=>false
			),
			array(
				'title'=>$this->country['varName'],
				'url'=>LinkCreator::create(array('varIdentifier'=>$this->country['intCountryID'], 'varModule'=>'country'), $this->all_alias),
				'thisPage'=>false
			),
			array(
				'title'=>'Курорты ('.$this->country['varName'].')',
				'url'=>'',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);	
		
	}
}

Kernel::ProcessPage(new IndexPage("resorts.tpl"));
