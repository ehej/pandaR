<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.AsvCountriesTable");

class IndexPage extends PublicPage {

	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	var $AdvCountriesTable;
	var $data;

	var $sfilter = array();
	
	function index() {
		parent::index();

		$this->countriesTable = new CountriesTable($this->connection);
		$this->AdvCountriesTable = new AdvCountriesTable($this->connection);
	
		if($f=$this->request->getNumber('intTypeID')) $sfilter['intTypeID']=$f;
		
		$this->data = $this->countriesTable->GetList($sfilter, array('varName'=>'ASC'), null, 'getWithData');
		$rel = $this->AdvCountriesTable->GetList();
		foreach ($rel as $value) {
			$tmp[$value['intParentCountry']] = $value;
		}
		$this->data_countries_relation = $tmp ;
		$fields = $this->modulesPagesTable->GetByFields(array('varPage' => 'countries'), null, true);
		$this->setPageTitle($fields['varMetaTitle'], $fields['varMetaKeywords'], $fields['varMetaDescription']);
		if (empty($this->data)) $this->response->redirect('/');
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('data_countries_relation', $this->data_countries_relation);
		foreach ($this->data as $value) {
			$value['varModule'] = 'countries';
			$value['link'] = LinkCreator::create($value, $this->all_alias);
			$tmp[] = $value;
		}
		$this->data = $tmp;
		$this->document->addValue('curCountryID', $this->data['intCountryID']);
		$this->document->addValue('data', $this->data);
		$this->breadCrumbs = array(
			array(
				'title'=>'Главная',
				'url'=>'/',
				'thisPage'=>false
			),
			array(
				'title'=>'Страны',
				'url'=>'',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);
	}
}

Kernel::ProcessPage(new IndexPage("countries.tpl"));