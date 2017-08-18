<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.DocumentTable");
Kernel::Import("classes.data.DocumentCategoryTable");

class IndexPage extends AdminPage {
	
	/**
	 * @var DocumentTable
	 */
	var $DocumentTable;
	/**
	 * @var DocumentCategoryTable
	 */
	var $DocumentCategoryTable;

	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Документы');
		$this->setBoldMenu('document');
		
		$this->DocumentTable = new DocumentTable($this->connection);
		$this->DocumentCategoryTable = new DocumentCategoryTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnSave() {
		$orderings = $this->request->Value('intOrdering');

		foreach($orderings as $key=>$ordering) {
			$data = array('intOrdering'=>$ordering, 'intDocumentID'=>$key);
			$this->DocumentTable->Update($data);
		}
		
		$this->addMessage('Данные успешно сохранены');
		$this->response->redirect('document.php');
	
	}
	
	function OnDelete() {
		$data = array('intDocumentID' => $this->request->getNumber('intDocumentID'));
		$data = $this->DocumentTable->Get($data);
		unlink(FILES_PATH.substr($data['varFileName'],0,3).'/'.$data['varFileName']);
		$this->DocumentTable->Delete($data);
		$this->addMessage('Документ удален');
		$this->response->redirect('document.php');
		
	}
	
	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'intOrdering');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varName')) && !empty($name)) $this->sfilter['LIKEvarName'] = $name;
		if ( ($name = $this->request->getString('intCategoryID')) && !empty($name)) $this->sfilter['intCategoryID'] = $name;
		
		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}

	function render() {
		parent::render();
		$this->document->addValue('FILES_URL', FILES_URL);
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC';
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);
		
		$tmp = array();
		$document = $this->DocumentTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);
		foreach ($document as $key => $value) {
			if($key === 'pager'){
				$pager = $value;
			}else{
				$value['link'] = FILES_URL.substr($value['varFileName'],0,3).'/'.$value['varFileName'];
				$tmp[] = $value;
			}
		}
		if(isset($pager))$tmp['pager'] = $pager;

		$document = $tmp;	
		
		$this->document->addValue('document', $document);
		
		$tmp = array();
		$category = $this->DocumentCategoryTable->GetList(null, array('varName'=>'ASC'));
		
		foreach ($category  as $key => $value) {
			$tmp[$value['intCategoryID']] = $value;
		}
		$category  = $tmp;	
		
		$this->document->addValue('category', $category );
		
		
	}

}

Kernel::ProcessPage(new IndexPage("document.tpl"));