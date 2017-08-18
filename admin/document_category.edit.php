<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

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
	
	var $data = false;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование категрии документов');
		$this->setBoldMenu('document_category');		
		$this->DocumentTable = new DocumentTable($this->connection);
		$this->DocumentCategoryTable = new DocumentCategoryTable($this->connection);
			
		$intCategoryID = $this->request->getNumber('intCategoryID', 0);
		if ($intCategoryID) {
			$this->data = $this->DocumentCategoryTable->Get(array('intCategoryID' => $intCategoryID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет документа с заданным ID');
				$this->response->redirect('document_category.php');
			}
		}
	}

 	function OnSave() {
		$data['intCategoryID'] 			= $this->request->getNumber('intCategoryID');
		$data['varName'] 				= $this->request->getString('varName', 'NotEmpty');
		$data['intOrdering'] 				= $this->request->getNumber('intOrdering');

		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if (isset($data['intCategoryID']) && !empty($data['intCategoryID'])) {
				$this->DocumentCategoryTable->Update($data);
			} else {
				$this->DocumentCategoryTable->Insert($data);
				$data['intCategoryID'] = $this->DocumentCategoryTable->getInsertId();
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intCategoryID']) && !empty($data['intCategoryID'])) $this->response->redirect('document_category.edit.php?intCategoryID='.$data['intCategoryID']);
		}
	}
	
	function render() {
		parent::render();
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('data', $this->data);		

	}

}

Kernel::ProcessPage(new IndexPage("document_category.edit.tpl"));