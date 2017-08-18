<?php
include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.GallerysTable");
Kernel::Import("classes.data.GalleriesToModulesTable");

class IndexPage extends AdminPage {

	/**
	 * @var GallerysTable
	 */
	var $gallerysTable;
	/**
	 * @var GalleriesToModulesTable
	 */
	var $galleriesToModulesTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Фотогалереи');
		$this->setBoldMenu('gallerys');
		
		$this->gallerysTable = new GallerysTable($this->connection);
		$this->galleriesToModulesTable = new GalleriesToModulesTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {			
		$data = array('intGalleryID' => $this->request->getNumber('intGalleryID'));	

		$gtm = $this->galleriesToModulesTable->GetList($data);
		if(count($gtm) > 0) {
			$flag = true;
			$this->addErrorMessage('Нельзя удалить галерею, т.к. с ней связанны записи в разделе "Страны" / "Регионы" / "Отели" / "Страницы"');
		} 
		
		if($flag) {
			return;
		} else {
			$this->gallerysTable->delete($data);
			$this->addMessage('Галерея удалена');	
			$this->response->redirect('gallerys.php');
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

		$pages = $this->gallerysTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		$this->document->addValue('gallerys_list', $pages);		
	}	
	
}

Kernel::ProcessPage(new IndexPage("gallerys.tpl"));
