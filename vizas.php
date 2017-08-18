<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.CountriesTable");


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


		$country = $this->countriesTable->GetByFields(array('varUrlAlias'=>$_REQUEST['varUrlAlias']));
		$this->sfilter['intCountryID'] = $country['intCountryID'];

	}
	
	function render() {
		parent::render();
		
		$tmpctours = $this->toursTable->GetList($this->sfilter, null, null, 'GetListWithNames');
		foreach($tmpctours as $tour) {
			$ctours[$tour['varCountryName']][] = $tour;
		}

		$this->document->addValue('ctours', $ctours);
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

Kernel::ProcessPage(new IndexPage("vizas.tpl"));