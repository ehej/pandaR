<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CategoryInfoTable");

class IndexPage extends AdminPage {
	
	public $CategoryInfoTable;
	public $data = false;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных категории');
		$this->setBoldMenu('category_info');		
		
		$this->CategoryInfoTable= new CategoryInfoTable($this->connection);	
		
		$intCategoryID = $this->request->getNumber('intCategoryID', 0);
		if ($intCategoryID) {
			$this->data = $this->CategoryInfoTable->Get(array('intCategoryID' => $intCategoryID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет категории с заданным ID');
				$this->response->redirect('category_info.php');
			}
		}
	}

 	function OnSave() {

		$data['intCategoryID'] = $this->request->getNumber('intCategoryID');
		$data['varName'] =	$this->request->getString('varName', 'NotEmpty');
		$data['intOrdering'] = $this->request->getNumber('intOrdering');
		$data['isActive'] = $this->request->getString('isActive');
		$data['isAllwaysOpen'] = $this->request->getString('isAllwaysOpen');
		
		if(empty($data['isActive'])) $data['isActive'] = 'No';
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if (isset($data['intCategoryID']) && !empty($data['intCategoryID'])) {
				$this->CategoryInfoTable->Update($data);
			} else {
				$this->CategoryInfoTable->Insert($data);
				$data['intCategoryID'] = $this->CategoryInfoTable->getInsertId();
			}
			
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intCategoryID']) && !empty($data['intCategoryID'])) $this->response->redirect('category_info.edit.php?intCategoryID='.$data['intCategoryID']);
		}
	}

	function render() {
		parent::render();
		$this->document->addValue('data', $this->data);
	}

}

Kernel::ProcessPage(new IndexPage("category_info.edit.tpl"));