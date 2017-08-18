<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.NewsTypeTable");

class IndexPage extends AdminPage {
	/**
	 * 
	 * @var NewsTypeTable
	 */
	public $NewsTypeTable;

	public $data = false;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных категории новостей');
		$this->setBoldMenu('news_type');		
		
		$this->NewsTypeTable= new NewsTypeTable($this->connection);	
		
		$intNewsTypeID = $this->request->getNumber('intNewsTypeID', 0);
		if ($intNewsTypeID) {
			$this->data = $this->NewsTypeTable->Get(array('intNewsTypeID' => $intNewsTypeID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет категории с заданным ID');
				$this->response->redirect('news_type.php');
			}
		}
	}

 	function OnSave() {

		$data['intNewsTypeID'] = $this->request->getNumber('intNewsTypeID');
		$data['varNameType'] =	$this->request->getString('varNameType', 'NotEmpty');
		$data['varUrlAlias'] = $this->request->getString('varUrlAlias', 'NotEmpty');
		$data['intOrdering'] = $this->request->getNumber('intOrdering');
		$data['isActive'] = $this->request->getString('isActive');
		if(empty($data['isActive'])) $data['isActive'] = 'No';
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if (isset($data['intNewsTypeID']) && !empty($data['intNewsTypeID'])) {
				$this->NewsTypeTable->Update($data);
			} else {
				$this->NewsTypeTable->Insert($data);
				$data['intNewsTypeID'] = $this->NewsTypeTable->getInsertId();
			}
			
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intNewsTypeID']) && !empty($data['intNewsTypeID'])) $this->response->redirect('news_type.edit.php?intNewsTypeID='.$data['intNewsTypeID']);
		}
	}

	function render() {
		parent::render();
		$this->document->addValue('data', $this->data);
	}

}

Kernel::ProcessPage(new IndexPage("news_type.edit.tpl"));