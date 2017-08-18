<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CommentsTable");

class IndexPage extends AdminPage {

	/**
	 * @var CommentsTable
	 */
	var $commentsTable;	
	
	var $data = false;
	
	var $intCommentID;

	function index() {
		parent::index();
		$this->setPageTitle('Редактирование отзыва');
		$this->setBoldMenu('comments');		
		
		$this->commentsTable = new CommentsTable($this->connection);
		
		$this->intCommentID = $this->request->getNumber('intCommentID', 0);
		if ($this->intCommentID) {
			$this->data = $this->commentsTable->Get(array('intCommentID' => $this->intCommentID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет отзыва с заданным ID');
				$this->response->redirect('comments.php');
			}
		}
	}
		
 	function OnSave() {
		$data['intCommentID'] = $this->request->getNumber('intCommentID');
		$data['varModuleName'] = $this->request->getString('varModuleName', 'NotEmpty');
		$data['intModuleID'] = $this->request->getNumber('intModuleID', 'NotEmpty');
		$data['varName'] =	$this->request->getString('varName', 'NotEmpty');
		$data['varComment'] = $this->request->getString('varComment', 'NotEmpty');
		$data['isActive'] = $this->request->getNumber('isActive');
		$data['varIsNew'] = 'no';
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			
			if (isset($data['intCommentID']) && !empty($data['intCommentID'])) {
				$this->commentsTable->Update($data);
			} else {
				$this->commentsTable->Insert($data);
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intCommentID']) && !empty($data['intCommentID'])) $this->response->redirect('comments.edit.php?intCommentID='.$data['intCommentID']);
		}
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('data', $this->data);
	}

}

Kernel::ProcessPage(new IndexPage("comments.edit.tpl"));