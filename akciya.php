<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.AkciiTable");


class IndexPage extends PublicPage {

	/**
	 * @var SpecialOffersTable
	 */
	var $akciiTable;
	var $data;
	
	function index() {
		parent::index();

		$this->akciiTable = new AkciiTable($this->connection);
		$intHotelID = $this->request->getNumber('intAkciyID', 0);
		if ($intHotelID) {
			$this->data = $this->akciiTable->Get(array('intAkciyID' => $intHotelID));
			if (empty($this->data)) $this->response->redirect('index.php');
		}
		
		$this->setPageTitle('Акция | '.$this->data['varTitle']);
	}

	function render() {
		parent::render();
		$this->data['varDescription'] = $this->insertForm($this->data['varDescription']);
		$this->document->addValue('data', $this->data);
		$this->breadCrumbs = array(
			array(
				'title'=>'Главная',
				'url'=>'/',
				'thisPage'=>false
			),
			array(
				'title'=>'Акции',
				'url'=>LinkCreator::create(array('varModule'=>'akcii'), $this->all_alias),
				'thisPage'=>false
			),
			array(
				'title'=>''.$this->data['varTitle'].'',
				'url'=>'',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);
	}
}

Kernel::ProcessPage(new IndexPage("akciya.tpl"));