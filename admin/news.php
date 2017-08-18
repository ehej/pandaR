<?php
include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.NewsTable");
Kernel::Import("classes.data.NewsTypeTable");
class IndexPage extends AdminPage {

	/**
	 *
	 * @var NewsTable
	 */
	var $newsTable;
	/**
	 *
	 * @var NewsTypeTable
	 */
	var $NewsTypeTable;
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Новости');
		$this->setBoldMenu('news');
		
		$this->newsTable = new NewsTable($this->connection);
		$this->NewsTypeTable = new NewsTypeTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$this->addErrorMessage('Новость удалена');		
		$data = array('intNewsID' => $this->request->getNumber('intNewsID'));		
		$this->newsTable->delete($data);
		$this->response->redirect('news.php');
	}

	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'varDate');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varTitle')) && !empty($name)) $this->sfilter['LIKEvarTitle'] = $name;
		
		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}
	
	function render() {
		parent::render();
		
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'DESC' : 'ASC';	
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);
		$tmp = array();
		$pages = $this->newsTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);

		foreach ($pages as $key => $value) {
			if($key === 'pager'){
				$pager = $value;
			}else{
				$value['varIdentifier'] = $value['intNewsID'];
				$value['varModule'] = 'news';
				$value['link'] = LinkCreator::create($value, $this->all_alias);
				$tmp[] = $value;
			}
		}
		if(isset($pager))$tmp['pager'] = $pager;
		$pages = $tmp;	
		$this->document->addValue('news_list', $pages);		
		$news_type = $this->NewsTypeTable->GetList(null, array('intOrdering'=>'ASC'));
		foreach ($news_type as $value) {
			$tmp[$value['intNewsTypeID']] = $value['varNameType'];
		}
		$news_type = $tmp;
		$this->document->addValue('news_type_list', $news_type);		
	}	
	
}

Kernel::ProcessPage(new IndexPage("news.tpl"));
