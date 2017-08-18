<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.StaffsTypeTable");

class IndexPage extends AdminPage {
	/**
	 * 
	 * @var StaffsTypeTable
	 */
	public $StaffsTypeTable;

	public $data = false;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных категории');
		$this->setBoldMenu('staffs_type');		
		
		$this->StaffsTypeTable= new StaffsTypeTable($this->connection);	
		
		$intTypeID = $this->request->getNumber('intTypeID', 0);
		if ($intTypeID) {
			$this->data = $this->StaffsTypeTable->Get(array('intTypeID' => $intTypeID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет категории с заданным ID');
				$this->response->redirect('staffs_type.php');
			}
		}
	}

 	function OnSave() {

		$data['intTypeID'] = $this->request->getNumber('intTypeID');
		$data['varNameType'] =	$this->request->getString('varNameType', 'NotEmpty');
		$data['intOrdering'] = $this->request->getNumber('intOrdering');
		$data['isActive'] = $this->request->getString('isActive');
		if(empty($data['isActive'])) $data['isActive'] = 'No';
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if (isset($data['intTypeID']) && !empty($data['intTypeID'])) {
				$this->StaffsTypeTable->Update($data);
			} else {
				$this->StaffsTypeTable->Insert($data);
			}
						
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intTypeID']) && !empty($data['intTypeID'])) $this->response->redirect('staffs_type.edit.php?intTypeID='.$data['intTypeID']);
		}
	}

	function render() {
		parent::render();
		$this->document->addValue('data', $this->data);
	}

}

Kernel::ProcessPage(new IndexPage("staffs_type.edit.tpl"));