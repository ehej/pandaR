<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.NewsTable");
Kernel::Import("classes.data.NewsTypeTable");
Kernel::Import("classes.data.SettingsTable");

class IndexPage extends PublicPage {

	/**
	 * @var NewsTable
	 */
	var $newsTable;
	var $newsTypeTable;
	var $data = false;
	
	function index() {
		parent::index();
		
		$this->newsTable = new NewsTable($this->connection);
		$this->NewsTypeTable = new NewsTypeTable($this->connection);
		$this->settingsTable 		    	= new SettingsTable($this->connection);
		
		$data['intNewsID'] = $this->request->getNumber('intNewsID', 0);
		$data['intActive'] = 1;
		if(!$this->isAuthorizated) $data['intOnlyAuthorized'] = $this->isAuthorizated;

		$settings = $this->settingsTable->Get(array('intSettingsID' => 1));
		$this->data = $this->newsTable->GetByFields($data, array('varDate' => 'DESC'));

		if ($this->data['intNewsID']) {
			$this->setPageTitle($this->data['varMetaTitle'], $this->data['varMetaDescription'], $this->data['varMetaKeywords']);
		} else {
			$this->response->redirect('/news_archive.php');
		}
	}
	
	function render() {
		parent::render();
		$this->data['varDescription'] = $this->insertForm($this->data['varDescription']);
		$this->document->addValue('data', $this->data);
		$this->type = $this->NewsTypeTable->Get(array('intNewsTypeID'=>$this->data['intNewsTypeID']));
		
		$this->breadCrumbs = array(
			array(
				'title'=>'Главная',
				'url'=>'/',
				'thisPage'=>false
			),
			array(
				'title'=>'Новости',
				'url'=>'/news',
				'thisPage'=>false
			),
			array(
				'title'=>$this->data['varTitle'],
				'url'=>'',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);
	}
}

Kernel::ProcessPage(new IndexPage("news.tpl"));