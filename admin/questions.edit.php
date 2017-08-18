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
	
	var $curQuestionID;
	var $curAnswerID;
	var $data = false;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных вопроса');
		$this->setBoldMenu('questions');		
		
		$this->contestsTable = new ContestsTable($this->connection);
		$this->questionsTable = new QuestionsTable($this->connection);
		$this->answersTable = new AnswersTable($this->connection);
			
		$intQuestionID = $this->request->getNumber('intQuestionID', 0);
		if ($intQuestionID) {
			$this->data = $this->questionsTable->Get( array('intQuestionID' => $intQuestionID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет вопроса с заданным ID');
				$this->response->redirect('questions.php');
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
		$data['varAnswerText'] = 'Введите текст ответа';
		
		if (!$this->request->getErrors()) {
			$this->curQuestionID = $data['intQuestionID'];
			$this->curAnswerID = $this->answersTable->Insert($data);
		}
	}
	
	function OnGetNewQuestionForm() {
		$this->setResponse(new SmartyResponse($this, $this->document, 'void.tpl'));
		$this->Template = 'empty_question.tpl';
		
		$data['intContestID'] = $this->request->getNumber('intContestID', 'NotEmpty');
		$data['varQuestionText'] = 'Введите текст вопроса';
		
		if (!$this->request->getErrors()) {
			$this->curQuestionID = $d['intQuestionID'] = $this->questionsTable->Insert($data);
			$d['varAnswerText'] = 'Введите текст ответа';
			$this->curAnswerID = $this->answersTable->Insert($d);
		}
	}
	
 	function OnSave() {
		$intContestID = $this->request->getNumber('intContestID', 'NotEmpty');
		$varQuestionText = $this->request->Value('varQuestionText');
		$varAnswerText = $this->request->Value('varAnswerText');
		$isRight = $this->request->Value('isRight');
		
		foreach ($varQuestionText as $key => $value) {
			$data = array();
			$data['intQuestionID'] = $key;
			$data['intContestID'] = $intContestID;
			$data['varQuestionText'] = $value;
			$this->questionsTable->Update($data);
		}
		
		$answers = $this->answersTable->GetList();

 		foreach ($varAnswerText as $key => $value) {
			$data = array();
			$data['intAnswerID'] = $key;
			$data['varAnswerText'] = $value;
	 		foreach ($answers as $ke=> $val) {
				if($val['intAnswerID'] == $key) {
					$data['intQuestionID'] = $val['intQuestionID'];
				}
			}
			foreach ($isRight as $k => $v) {
				if($key == $v) {
					$data['isRight'] = 1;
				}
			}
			$this->answersTable->Update($data);
		}
 		if (isset($intContestID) && !empty($intContestID)) {
 			$this->addMessage('Данные успешно сохранены.');
			$this->response->redirect('contests.edit.php?intContestID='.$intContestID);
		}
	}

	function render() {
		parent::render();
		
		$this->document->addValue('data', $this->data);
		$this->document->addValue('curQuestionID', $this->curQuestionID);
		$this->document->addValue('curAnswerID', $this->curAnswerID);
		$this->document->addValue('contests_list', $this->contestsTable->GetList());
		if(!empty($this->data['intQuestionID'])) {
			$this->document->addValue('questions_list', $this->questionsTable->GetList(array('intContestID' => $this->data['intContestID'])));
			$this->document->addValue('answers_list', $this->answersTable->GetList(array('intQuestionID' => $this->data['intQuestionID'])));
		}
	}

}

Kernel::ProcessPage(new IndexPage("questions.edit.tpl"));