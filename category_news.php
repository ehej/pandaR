<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.NewsTable");
Kernel::Import("classes.data.NewsTypeTable");
Kernel::Import("classes.data.ModulesPagesTable");

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
	var $intNewsTypeID;
	
	var $page = 1;
	
	function index() {
		parent::index();

		$this->newsTable = new NewsTable($this->connection);
		$this->modulesPagesTable = new ModulesPagesTable($this->connection);
		$this->NewsTypeTable = new NewsTypeTable($this->connection);
		
		
		$intNewsTypeID = $this->request->getNumber('intNewsTypeID');
		
		$varUrlAlias = $this->request->getString('varUrlAlias');
		if(empty($intNewsTypeID)) {
			$intNewsTypeID = LinkCreator::url_to_id('news_type',$varUrlAlias,$this->all_alias);
		}
		
		$this->data = $this->NewsTypeTable->GetByFields(array('intNewsTypeID'=>$intNewsTypeID, 'isActive' =>'yes'));
		
		if ($intNewsTypeID) {
			$this->intNewsTypeID = $intNewsTypeID;
			$this->setPageTitle(''.$this->data['varNameType'], $this->data['varMetaDescription'], $this->data['varMetaKeywords']);
		} else {
			$this->response->redirect('/');	
		}
		
		$this->setFilters();
	}

	function setFilters() {
		if ( ($name = $this->request->getString('varDateFrom')) && !empty($name)) $this->sfilter['FROMvarDate'] = date('Y-m-d H:i:s',strtotime($name));
		if ( ($name = $this->request->getString('varDateTo')) && !empty($name)) $this->sfilter['TOvarDate'] = date('Y-m-d H:i:s',strtotime($name));	
		$this->sfilter['intActive'] = 1;
		$this->sfilter['intNewsTypeID'] = $this->intNewsTypeID;		
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
				if($value['intNewsTypeID'] == $this->intNewsTypeID){
					$news_type_now = $value;
				}
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
			}else{
				$value['varIdentifier'] = $value['intNewsID'];
				$value['varModule'] = 'news';
				$value['link'] = LinkCreator::create($value, $this->all_alias);
				$tmp[] = $value;
				
			}
		}
		if(isset($pager)){$tmp['pager'] = $pager; unset($pager);}

		$news = $tmp;	
		
		$this->document->addValue('data', $news);
		$this->document->addValue('category_now', $news_type_now);
		
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
				'title'=>$this->data['varNameType'],
				'url'=>'',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);	
	}
}

Kernel::ProcessPage(new IndexPage("category_news.tpl"));