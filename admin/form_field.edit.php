<?php
include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.unit.FormCreator");
Kernel::Import("classes.data.FormsTable");
Kernel::Import("classes.data.FormFieldsTable");

class IndexPage extends AdminPage {

	var $FormsTable;
	var $FormFieldsTable;
	var $data;
	var $intFormID;
	
	function index() {
		parent::index();
		
		$this->setBoldMenu('forms');
		
		$this->FormsTable = new FormsTable($this->connection);
		$this->FormFieldsTable = new FormFieldsTable($this->connection);
		
		$this->intFormID = $this->request->getNumber('intFormID', 0);
		$this->document->addValue('intFormID', $this->intFormID);	
		
		$this->intFieldID = $this->request->getNumber('intFieldID', 0);
		
		$this->checkSuperAdmin();
		
		if ($this->intFieldID) {
			$this->setPageTitle('Редактирование поля формы');
			$this->data = $this->FormFieldsTable->Get(array('intFieldID' => $this->intFieldID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет поля в форме с заданным ID');
				$this->response->redirect('forms.edit.php?intFormID='.$this->intFormID);
			}
		}else{
			$this->setPageTitle('Добавление поля формы');
		}
		
	}
	
	function OnSave() {
		$data['intFieldID'] 		= $this->request->getNumber('intFieldID', 0);
		$data['intFormID']			= $this->request->getNumber('intFormID');
		$data['intOrdering']        = $this->request->getNumber('intOrdering');
		$data['varType']            = $this->request->getString('varType', 'NotEmpty');
		$data['varName']            = $this->request->getString('varName', 'NotEmpty');
		$data['varDescription']     = $this->request->getString('varDescription');
		$data['intImportant']       = $this->request->getNumber('intImportant');
		$data['varCheck']           = $this->request->getString('varCheck');
		$data['varErrorMessage']    = $this->request->getString('varErrorMessage');
		$data['intMaxLenght']       = $this->request->getNumber('intMaxLenght');
		$data['intSizeW']           = $this->request->getNumber('intSizeW');
		$data['intSizeH']           = $this->request->getNumber('intSizeH');
		$data['varDefaultValue']    = $this->request->getString('varDefaultValue');
		$data['varValues']          = $this->request->getString('varValues');
		$data['varAttribute']       = $this->request->getString('varAttribute');
		$data['varTableSelect']     = $this->request->getString('varTableSelect');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			
			if (!empty($data['intFieldID'])) {
			   	$this->FormFieldsTable->Update($data);
			} else {
			   	$this->FormFieldsTable->Insert($data);
			   	$data['intFieldID'] = $this->FormFieldsTable->getInsertId();
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intFieldID']) && !empty($data['intFieldID'])) $this->response->redirect('form_field.edit.php?intFormID='.$data['intFormID'].'&intFieldID='.$data['intFieldID']);
		}
	}
	
	function render() {
		parent::render();
		$this->document->addValue('data', $this->data);	

		$this->document->addValue('FieldCheck', FormCreator::GetFieldCheck());
		$this->document->addValue('FieldType', FormCreator::GetFieldType());
		$this->document->addValue('FieldTableSelect', FormCreator::GetFieldTableSelect());
	}	
}

Kernel::ProcessPage(new IndexPage("form_fields.edit.tpl"));