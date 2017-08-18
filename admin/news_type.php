<?php
include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.NewsTypeTable");

class IndexPage extends AdminPage {

	/**
	 *
	 * @var NewsTypeTable
	 */
	var $NewsTypeTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Категории новостей');
		$this->setBoldMenu('news_type');
		
		$this->NewsTypeTable = new NewsTypeTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$this->addErrorMessage('Категория новостей удалена');		
		$data = array('intNewsTypeID' => $this->request->getNumber('intNewsTypeID'));		
		$this->NewsTypeTable->delete($data);
		$this->response->redirect('news_type.php');
	}
	
	function OnSave() {
		$orderings = $this->request->Value('intOrdering');

		foreach($orderings as $key=>$ordering) {
			$data = array('intOrdering'=>$ordering, 'intNewsTypeID'=>$key);
			$this->NewsTypeTable->Update($data);
		}
		$this->addMessage('Данные успешно сохранены');
		$this->response->redirect('news_type.php');
	}

	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'intOrdering');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varNameType')) && !empty($name)) $this->sfilter['LIKEvarNameType'] = $name;
		
		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}
	
	function render() {
		parent::render();
		
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'DESC' : 'ASC' ;	
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);

		$pages = $this->NewsTypeTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);
		$this->document->addValue('news_type_list', $pages);		
	}	
	
}

Kernel::ProcessPage(new IndexPage("news_type.tpl"));
