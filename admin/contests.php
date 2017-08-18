<?php
include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.ContestsTable");
Kernel::Import("classes.data.QuestionsTable");
Kernel::Import("classes.data.AnswersTable");
Kernel::Import("classes.data.PagesTable");
Kernel::Import("classes.data.NewsTable");
Kernel::Import("classes.data.ModulesPagesTable");

class IndexPage extends AdminPage {

	/**
	 * @var ContestsTable
	 */	
	var $contestsTable;
	/**
	 * @var QuestionsTable
	 */
	var $questionsTable;
	/**
	 * @var AnswersTable
	 */
	var $answersTable;
	/**
	 * @var PagesTable
	 */
	var $pagesTable;
	/**
	 * @var NewsTable
	 */
	var $newsTable;
	/**
	 * @var ModulesPagesTable
	 */
	var $modulesPagesTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Конкурсы');
		$this->setBoldMenu('contests');
		
		$this->contestsTable = new ContestsTable($this->connection);
		$this->questionsTable = new QuestionsTable($this->connection);
		$this->answersTable = new AnswersTable($this->connection);
		$this->pagesTable = new PagesTable($this->connection);
		$this->newsTable = new NewsTable($this->connection);
		$this->modulesPagesTable = new ModulesPagesTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {			
		$data['intContestID'] = $this->request->getNumber('intContestID');
		
		$tmpData = array('intContestID' => $this->request->getNumber('intContestID'));
		$p = $this->pagesTable->GetList($tmpData);
		if(count($p) > 0) {
			$this->addErrorMessage('Нельзя удалить конкурс, т.к. с ним связанны записи из раздела "Страницы"');
			return;
		}
		
		$questions = $this->questionsTable->GetList($data);
		foreach ($questions as $key => $value) {
			$arr = array('intQuestionID' => $value['intQuestionID']);
			$this->answersTable->DeleteByFields($arr);
		}
		$intContestID = $data['intContestID'];
		$arr = array('intContestID' => $intContestID);
		$this->questionsTable->DeleteByFields($arr);
		$this->contestsTable->Delete($data);
		$this->addMessage('Конкурс удален');	
		$this->response->redirect('contests.php');
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

		$pages = $this->contestsTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		$this->document->addValue('contests_list', $pages);		
		
		$this->document->addValue('pages', $this->pagesTable->GetList());
		$this->document->addValue('news', $this->newsTable->GetList());
		$this->document->addValue('modules_pages', $this->modulesPagesTable->GetList());
	}	
	
}

Kernel::ProcessPage(new IndexPage("contests.tpl"));