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
	public $form;
	
	function index() {
		parent::index();
		
		$this->setBoldMenu('forms');
		
		$this->FormsTable = new FormsTable($this->connection);
		$this->FormFieldsTable = new FormFieldsTable($this->connection);
		
		$this->form = new FormCreator($this->connection);
		
		$this->intFormID = $this->request->getNumber('intFormID', 0);
		
		$this->checkSuperAdmin();
		
		if ($this->intFormID) {
			$this->setPageTitle('Редактирование формы');
			$this->data = $this->FormsTable->Get(array('intFormID' => $this->intFormID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет формы с заданным ID');
				$this->response->redirect('forms.php');
			}
		}else{
			$this->setPageTitle('Добавление формы');
		}
	}
	
	function OnDelete() {
		$this->addMessage('Поле удалено');		
		$data = array('intFieldID' => $this->request->getNumber('intFieldID'));		
		$this->FormFieldsTable->delete($data);
		$this->response->redirect('forms.edit.php?intFormID='.$this->intFormID);
	}
	
	function OnSave() {

		$data['intFormID'] 				= $this->request->getNumber('intFormID', 0);
		$data['varName'] 				= $this->request->getString('varName', 'NotEmpty');	
		$data['varEmailTO'] 			= $this->request->getString('varEmailTO', 'Email');	
		$data['varEmailFrom'] 			= $this->request->getString('varEmailFrom', 'Email');	
		$data['varFromName'] 			= $this->request->getString('varFromName');
		$data['varSubject'] 			= $this->request->getString('varSubject');	
		$data['varTemplate'] 			= $this->request->getString('varTemplate');
		$data['varTemplateForm'] 		= $this->request->getString('varTemplateForm');
		$data['varIdentificator'] 		= $this->request->getString('varIdentificator');	
		$data['varDescription'] 		= $this->request->getString('varDescription');
		$data['isActive'] 				= $this->request->getString('isActive');

		$check_ident = $this->FormsTable->GetByFields(array('varIdentificator'=>$data['varIdentificator'], 'NOTintFormID' => $data['intFormID']));
		if(count($check_ident)>0){
			$this->request->setError('varIdentificator', 'Unicue');
			$this->addErrorMessage('Идентификатор должен быть уникальным');
		}
		
		if(strpos($data['varTemplate'], '{table-fields}')===false){
			$this->request->setError('varTemplate', 'NotEmpty');
			$this->addErrorMessage('В поле темплейта обязательно должна быть вставка "{table-fields}" ');
		}
		if(strpos($data['varTemplateForm'], '{table-fields}')===false || strpos($data['varTemplateForm'], '{button-submit}')===false){
			$this->request->setError('varTemplateForm', 'NotEmpty');
			$this->addErrorMessage('В поле темплейта для обязательно должна быть вставка "{table-fields}" и "{button-submit}" ');
		}
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			
			if (!empty($data['intFormID'])) {
			   	$this->FormsTable->Update($data);
			} else {
			   	$this->FormsTable->Insert($data);
			   	$data['intFormID'] = $this->FormsTable->getInsertId();
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intFormID']) && !empty($data['intFormID'])) $this->response->redirect('forms.edit.php?intFormID='.$data['intFormID']);
		}
	}
	
	function OnGetForms(){
		$data = $this->form->CreateForm($this->data['varIdentificator']);
		$this->response->maintemplate = '../'.$this->form->getTemplatesRoot().'/layout_head.tpl';
		$this->document->addValue('data', $data);	
		echo $this->response->display();
		die;
	}
	
	function render() {
		parent::render();
		$this->document->addValue('data', $this->data);	
		$this->document->addValue('form_html', $form_html);
		$form_fields_list = $this->FormFieldsTable->GetList(array('intFormID'=>$this->data['intFormID']),array('intOrdering'=>'ASC'));
		$this->document->addValue('form_fields_list', $form_fields_list);
		$this->document->addValue('FieldType', FormCreator::GetFieldType());		
	}	
}

Kernel::ProcessPage(new IndexPage("forms.edit.tpl"));
