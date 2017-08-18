<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CommentsTable");
Kernel::Import("classes.data.PagesTable");
Kernel::Import("classes.data.NewsTable");

class IndexPage extends AdminPage {

	/**
	 *
	 * @var CommentsTable
	 */
	var $commentsTable;
	/**
	 *
	 * @var PagesTable
	 */
	var $pagesTable;
	/**
	 *
	 * @var NewsTable
	 */
	var $newsTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		$this->setPageTitle('Отзывы');
		$this->setBoldMenu('comments');
		
		$this->commentsTable = new CommentsTable($this->connection);
		$this->pagesTable = new PagesTable($this->connection);
		$this->newsTable = new NewsTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnGetNewComments() {
		$this->sfilter['varIsNew'] = 'yes';
		$this->document->addValue('event', 'getNewComments');	
	}
	
	function OnDelete() {			
		$data = array('intCommentID' => $this->request->getNumber('intCommentID'));		
		$this->commentsTable->Delete($data);
		$this->response->redirect('comments.php');
		$this->addMessage('Отзыв удален');	
	}

	function OnDeleteItems() {
		$checkBoxes = $this->request->Value('checkBox');
		
		if(!empty($checkBoxes)) {
			foreach($checkBoxes as $key => $value) {
				$data = array('intCommentID' => $value);
				$this->commentsTable->Delete($data);
			}
			$this->response->redirect('comments.php');
			$this->addMessage('Отзывы удалены');	
		}
	}
	
	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'varIsNew');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varName')) && !empty($name)) $this->sfilter['LIKEvarName'] = $name;
		
		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}
	
	function render() {
		parent::render();
		
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC';	
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);

		$pages = $this->commentsTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		$this->document->addValue('comments_list', $pages);	
		$this->document->addValue('pages_list', $this->pagesTable->GetList());
		$this->document->addValue('news_list', $this->newsTable->GetList());
	}	
	
}

Kernel::ProcessPage(new IndexPage("comments.tpl"));