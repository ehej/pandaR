<?php
include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.PagesTable");
Kernel::Import("classes.data.SPOEditorsTable");
Kernel::Import("classes.data.MenuTable");

class IndexPage extends AdminPage {

	/**
	 * @var PagesTable
	 */
	var $pagesTable;
	/**
	 * @var SPOEditorsTable
	 */
	var $SPOEditorsTable;
	/**
	 * @var MenuTable
	 */
	var $menuTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Страницы');
		$this->setBoldMenu('pages');
		
		$this->pagesTable = new PagesTable($this->connection);
		$this->SPOEditorsTable = new SPOEditorsTable($this->connection);
		$this->menuTable = new MenuTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$data = array('intPageID' => $this->request->getNumber('intPageID'));	

		$tmpData = array('varIdentifier' => $this->request->getNumber('intPageID'), 'varModule' => 'page');
		
		$m = $this->menuTable->GetList($tmpData);
		if(count($m) > 0) {
			$flag = true;
			$this->addErrorMessage('Нельзя удалить страницу, т.к. с ней связанны записи из раздела "Меню"');
		}
		
		if($flag) {
			return;
		} else {
			$this->pagesTable->delete($data);
			$this->addErrorMessage('Страница удалена');	
			$this->response->redirect('pages.php');
		}
	}

	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'varTitle');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varTitle')) && !empty($name)) $this->sfilter['LIKEvarTitle'] = $name;
		
		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}
	
	function render() {
		parent::render();
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC';	
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);

		$tmp = array();
		$pages = $this->pagesTable->GetList($this->sfilter, $sort, null, null, 'getSQLRows', true, $this->page, DEFAULT_ITEMSPERPAGE);	
		
		foreach ($pages as $key => $value) {
			if(!is_integer($key)){
				$pager = $value;
			}else{
				$value['varIdentifier'] = $value['intPageID'];
				$value['varModule'] = 'page';
				$value['link'] = LinkCreator::create($value, $this->all_alias);
				$tmp[] = $value;
			}
		}
		if(isset($pager))$tmp['pager'] = $pager;
		$pages = $tmp;	
		
		$this->document->addValue('pages_list', $pages);		
	}	
	
}

Kernel::ProcessPage(new IndexPage("pages.tpl"));
