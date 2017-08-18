<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.AkciiTable");


class IndexPage extends PublicPage {

	/**
	 * @var SpecialOffersTable
	 */
	var $akciiTable;

	
	var $sfilter = array();
	var $intDepadtureCityID;
	
	function index() {
		parent::index();

		$this->akciiTable = new AkciiTable($this->connection);
	
		$this->setFilters();
	}

	function setFilters() {
		$this->sfilter['isShow'] = 1;
		$this->intDepadtureCityID = $this->request->getNumber('intDepadtureCityID');
		if (!empty($this->intDepadtureCityID)) $this->sfilter['intDepadtureCityID'] = $this->intDepadtureCityID;
	}
	

	function render() {
		parent::render();
		$akcii = $this->akciiTable->GetList(null, array('varDate' => 'DESC'));
		
		$tmp = array();
		foreach ($akcii as $key => $value) {
			if(!is_integer($key)){
				$pager = $value;
			}else{
				$value['varIdentifier'] = $value['intAkciyID'];
				$value['varModule'] = 'akciya';
				$value['link'] = LinkCreator::create($value, $this->all_alias);
				$tmp[] = $value;
			}
		}
		if(isset($pager))$tmp['pager'] = $pager;
		$akcii = $tmp;	
		
		$this->document->addValue('akcii', $akcii);
		
		$this->breadCrumbs = array(
			array(
				'title'=>'Главная',
				'url'=>'/',
				'thisPage'=>false
			),
			array(
				'title'=>'Акции',
				'url'=>LinkCreator::create(array('varModule'=>'akcii'), $this->all_alias),
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);
		
	}
}

Kernel::ProcessPage(new IndexPage("akcii.tpl"));