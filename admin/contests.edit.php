<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.ContestsTable");
Kernel::Import("classes.data.QuestionsTable");
Kernel::Import("classes.data.AnswersTable");

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
	
	var $data = false;
	var $isNew = false;
	
	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных конкурса');
		$this->setBoldMenu('contests');		
		
		$this->contestsTable = new ContestsTable($this->connection);
		$this->questionsTable = new QuestionsTable($this->connection);
		$this->answersTable = new AnswersTable($this->connection);
		
		$intContestID = $this->request->getNumber('intContestID', 0);
		if ($intContestID) {
			$this->data = $this->contestsTable->Get( array('intContestID' => $intContestID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет конкурса с заданным ID');
				$this->response->redirect('contests.php');
			}
		}
	}
	
	function OnDeleteAnswer() {
		$data['intAnswerID'] = $this->request->getNumber('intAnswerID', 'NotEmpty');	
		
		if (!$this->request->getErrors()) {
			$this->answersTable->delete($data);
			echo 'delete';
			$this->terminatePage();
		}
	}
	
	function OnGetNewAnswerForm() {
		$this->setResponse(new SmartyResponse($this, $this->document, 'void.tpl'));
		$this->Template = 'empty_answer.tpl';
		
		$data['intQuestionID'] = $this->request->getNumber('intQuestionID', 'NotEmpty');
		
		if (!$this->request->getErrors()) {
			$this->curAnswerID = $this->answersTable->Insert($data);
		}
	}
	
 	function OnSave() {
		$data['intContestID'] = $this->request->getNumber('intContestID');
		$data['varTitle'] =	$this->request->getString('varTitle', 'NotEmpty');
		$data['intCountQuestionsInPage'] = $this->request->getNumber('intCountQuestionsInPage', 'NotEmpty');	
		
		if ($this->request->getErrors()) {		
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if (isset($data['intContestID']) && !empty($data['intContestID'])) {
				$this->contestsTable->Update($data);
			} else {
				$intContestID = $this->contestsTable->Insert($data);
				$d = array('intContestID' => $intContestID, 'varQuestionText' => 'Введите текст вопроса');
				$intQuestionID = $this->questionsTable->Insert($d);
				$dd = array('intQuestionID' => $intQuestionID, 'varAnswerText' => '', 'isRight' => 0);
				$intAnswerID = $this->answersTable->Insert($dd);
				$this->data['intContestID'] = $intContestID;
				$this->data['intQuestionID'] = $intQuestionID;
			}
		}
		$this->isSaved = true;
	}

	function render() {
		parent::render();
		
		$this->document->addValue('data', $this->data);
		$this->document->addValue('curAnswerID', $this->curAnswerID);
		if($this->isSaved) {
			$this->document->addValue('contests_list', $this->contestsTable->GetList());
			$this->document->addValue('answers_list', $this->answersTable->GetList());
			$this->document->addValue('questions_list', $this->questionsTable->GetList(array('intContestID' => $this->data['intContestID'])));
			$this->Template = 'questions.edit.tpl'; 
		}
	}

}

Kernel::ProcessPage(new IndexPage("contests.edit.tpl"));