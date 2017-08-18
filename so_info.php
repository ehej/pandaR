<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.SpecialOffersTable");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.RegionsTable");

class IndexPage extends PublicPage {

	/**
	 * @var SpecialOffersTable
	 */
	var $specialOffersTable;
	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	/**
	 * @var RegionsTable
	 */
	var $regionsTable;
	
	var $data;
	var $intMenuID;
	
	function index() {
		parent::index();
		
		$this->specialOffersTable = new SpecialOffersTable($this->connection);
		$this->countriesTable = new CountriesTable($this->connection);
		$this->regionssTable = new RegionsTable($this->connection);
		
		$data['intSpecOffID'] = $this->request->getNumber('intSpecOffID');
		$data['isShow'] = 1;
		
		$this->data = $this->specialOffersTable->GetByFields($data);
		
		if ($this->data['intSpecOffID']) {
			$this->setPageTitle($this->data['varName']);
		} else {
			$this->setTemplate('access_denied.tpl');
		}
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('data', $this->data);
		$this->document->addValue('countries', $this->countriesTable->GetList());
		$this->document->addValue('regions', $this->regionsTable->GetList());
	}
}

Kernel::ProcessPage(new IndexPage("so_info.tpl"));