<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.NewsTable");
Kernel::Import("classes.data.NewsTypeTable");
Kernel::Import("classes.data.ModulesPagesTable");
Kernel::Import("classes.data.SettingsTable");

class IndexPage extends PublicPage {

	/**
	 * @var NewsTable
	 */
	var $newsTable;
	/**
	 *
	 * @var NewsTypeTable
	 */
	var $NewsTypeTable;
	/**
	 * @var ModulesPagesTable
	 */
	var $modulesPagesTable;
	
	var $page = 1;
	
	function index() {
		parent::index();

		$this->newsTable = new NewsTable($this->connection);
		$this->modulesPagesTable = new ModulesPagesTable($this->connection);
		$this->NewsTypeTable = new NewsTypeTable($this->connection);
		$this->settingsTable 		    	= new SettingsTable($this->connection);

		$settings = $this->settingsTable->Get(array('intSettingsID' => 1));
		$fields = $this->modulesPagesTable->GetByFields(array('varPage' => 'news_archive'),null, true);
		$this->setPageTitle($fields['varMetaTitle'], $fields['varMetaKeywords'], $fields['varMetaDescription']);

		$this->setFilters();
	}

	function setFilters() {
		$this->sfilter['TOvarDate'] = date('Y-m-d H:i:s');
		$this->sfilter['intActive'] = 1;
		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', null, 1);
	}
	
	function render() {
		parent::render();

		$this->document->addValue('sfilter', $this->sfilter);
	
		$newsType = $this->NewsTypeTable->GetList(array('isActive'=>'yes'), array('intOrdering'=>'ASC'));

		foreach ($newsType as $key => $value) {
			if($key === 'pager'){
				$pager = $value;
			}else{
				$value['varIdentifier'] = $value['intNewsTypeID'];
				$value['varModule'] = 'news_type';
				$value['link'] = LinkCreator::create($value, $this->all_alias);
				$tmp[] = $value;
			}
		}
		if(isset($pager)){$tmp['pager'] = $pager; unset($pager);}
		$newsType = $tmp;
		$this->document->addValue('dataType', $newsType);
		
		$tmp = array();
		$news = $this->newsTable->GetList($this->sfilter, array('varDate'=>'DESC'), null, null, 'getSQLRows', true, $this->page, DEFAULT_ITEMSPERPAGE);
		
		foreach ($news as $key => $value) {
			if($key === 'pager'){
				$pager = $value;
			} else {
				$value['varIdentifier'] = $value['intNewsID'];
				$value['varModule'] = 'news';
				$value['link'] = LinkCreator::create($value, $this->all_alias);
				$tmp[] = $value;
			}
		}
		if(isset($pager)){$tmp['pager'] = $pager; unset($pager);}

		$news = $tmp;	
		
		$this->document->addValue('data', $news);
		$this->breadCrumbs = array(
			array(
				'title'=>'Главная',
				'url'=>'/',
				'thisPage'=>false
			),
			array(
				'title'=>'Новости',
				'url'=>'',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);	
		
	}
}

Kernel::ProcessPage(new IndexPage("news_archive.tpl"));