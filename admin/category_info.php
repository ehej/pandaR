<?php
include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CategoryInfoTable");

class IndexPage extends AdminPage {

	/**
	 *
	 * @var CategoryInfoTable
	 */
	var $CategoryInfoTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Категории "Информации"');
		$this->setBoldMenu('category_info');
		
		$this->CategoryInfoTable = new CategoryInfoTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$this->addErrorMessage('Категория удалена');		
		$data = array('intCategoryID' => $this->request->getNumber('intCategoryID'));		
		$this->CategoryInfoTable->delete($data);
		$this->response->redirect('category_info.php');
	}
	
	function OnSave() {
		$orderings = $this->request->Value('intOrdering');

		foreach($orderings as $key=>$ordering) {
			$data = array('intOrdering'=>$ordering, 'intCategoryID'=>$key);
			$this->CategoryInfoTable->Update($data);
		}
		$this->addMessage('Данные успешно сохранены');
		$this->response->redirect('category_info.php');

	}

	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'intOrdering');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varName')) && !empty($name)) $this->sfilter['LIKEvarName'] = $name;
		
		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}
	
	function render() {
		parent::render();
		
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'DESC' : 'ASC' ;	
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);

		$pages = $this->CategoryInfoTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);
		$this->document->addValue('data_list', $pages);		
	}	
	
}

Kernel::ProcessPage(new IndexPage("category_info.tpl"));
