<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.HotelsTable");
Kernel::Import("classes.data.CountriesTable");

class IndexPage extends PublicPage {

	/**
	 * @var HotelsTable
	 */
	var $hotelsTable;
	/**
	 * @var RegionsTable
	 */
	var $regionsTable;
	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	
	var $data = false;
	var $country;
	
	function index() {
		parent::index();

		$this->hotelsTable = new HotelsTable($this->connection);
		$this->regionsTable = new RegionsTable($this->connection);
		$this->countriesTable = new CountriesTable($this->connection);

		$intCountryID = $this->request->getNumber('intCountryID', 0);
		$this->country = $this->countriesTable->Get(array('intCountryID' => $intCountryID));
		if ($intCountryID) {
			$this->data = $this->regionsTable->getListIDsNamesByCountryID($intCountryID);
			if (empty($this->data)) {
				$this->response->redirect('index.php');
			}
		}
		
		$this->setPageTitle('Отели и регионы | '.$this->country['varName'], $this->country['varMetaKeywords'], $this->country['varMetaDescription']);
	}

	function render() {
		parent::render();
		
		foreach ($this->data as $key => $value) {
			$hotels = $this->hotelsTable->getListIDsNamesByRegionID($value['intRegionID']);
			if(count($hotels) > 0) $this->data[$key]['hotels'] = $hotels;
		}
		$this->data['country'] = $this->country;
		
		$this->document->addValue('data', $this->data);	
	}
}

Kernel::ProcessPage(new IndexPage("regions_and_hotels.tpl"));