<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.PreferencesTable");
Kernel::Import("classes.data.ModulesPagesTable");

class IndexPage extends PublicPage {

	/**
	 * @var PreferencesTable
	 */
	var $preferencesTable;
	/**
	 * @var ModulesPagesTable
	 */
	var $modulesPagesTable;
	
	var $varDateFrom;
	var $varDateTo;
	
	function index() {
		parent::index();
		
		$this->preferencesTable = new PreferencesTable($this->connection);
		$this->modulesPagesTable = new ModulesPagesTable($this->connection);
		
		$fields = $this->modulesPagesTable->GetByFields(array('varPage' => 'currency_courses'), null, true);
		$this->setPageTitle($fields['varMetaTitle'], $fields['varMetaKeywords'], $fields['varMetaDescription']);
		
		$this->varDate = strtotime($this->request->getString('varDate'));
	}

	function render() {
		parent::render();
		
		if (!empty($this->varDate)) { 
			$curTime = $this->varDate;	
		} else {
			$curTime = time();	
		}
		$this->document->addValue('curTime', $curTime);
		
		$this->document->addValue('gte', $tmpArr);
		$this->breadCrumbs = array(
			array(
				'title'=>'Главная',
				'url'=>'/',
				'thisPage'=>false
			),
			array(
				'title'=>'Архив курса валют',
				'url'=>'',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);
	}
}

Kernel::ProcessPage(new IndexPage("currency_courses.tpl"));