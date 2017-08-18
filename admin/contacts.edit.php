<?php
include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.ContactsTable");
Kernel::Import("classes.data.ContactsContactTable");


class IndexPage extends AdminPage {

	var $ContactsTable;
	var $ContactsContactTable;
	var $data;
	
	function index() {
		parent::index();
		
		$this->setBoldMenu('contacts');
		
		$this->ContactsTable = new ContactsTable($this->connection);
		$this->ContactsContactTable = new ContactsContactTable($this->connection);
				
		$this->intContactID = $this->request->getNumber('intContactID', 0);
		
		$this->checkSuperAdmin();
		
		if ($this->intContactID) {
			$this->setPageTitle('Редактирование контакта');
			$this->data = $this->ContactsTable->Get(array('intContactID' => $this->intContactID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет сотрудника с заданным ID');
				$this->response->redirect('contacts.php');
			}
			$this->data['contacts'] = $this->ContactsContactTable->GetList(array('intContactID'=>$this->data['intContactID']));
		}else{
			$this->setPageTitle('Добавление контакта');
		}
		
	}
	
	function OnSave() {
		$data['intContactID'] 	= $this->request->getNumber('intContactID', 0);
		$data['varName'] 		= $this->request->getString('varName', 'NotEmpty');	
		$data['varView'] 		= $this->request->getString('varView', 'NotEmpty');	
		$data['varMain'] 		= $this->request->getString('varMain');	
		$data['varInfo'] 		= $this->request->getString('varInfo');	
		$data['varTransport']	= $this->request->getString('varTransport');	
		$varFoto 				= $this->request->getFiles('varFoto');
		$varFoto_Clear 			= $this->request->getNumber('varFoto_Clear', 0);
		$contacts 				= $this->request->Value('contacts');	
		$contacts_type 			= $this->request->Value('contacts_type');	
		foreach ($contacts as $key => $value) {
			$tmp[$key] = array('varText'=>$value, 'varStaffType'=>$contacts_type[$key]);
		}
		$contacts = $tmp;
		
		if ($varFoto['size']) {
            $file_path = FOTO_CONTACTS;         
            if(!is_dir($file_path)){
				mkdir($file_path,0777);
            }
            if (!empty($this->data['varFoto'])) unlink($file_path.$this->data['varFoto']);       
            $file_pathinfo = pathinfo($varFoto['name']);
            $file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
            move_uploaded_file($varFoto['tmp_name'], $file_path.$file_name);
            chmod($file_path.$file_name, 0777);
            $data['varFoto'] = $file_name;
        } else {
            if($varFoto_Clear == 1){
                $data['varFoto'] = '';
            }else{
                $data['varFoto'] = $this->data['varFoto'];
            }
        }

		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->data['contacts'] = $contacts;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			
			if (!empty($data['intContactID'])) {
			   	$this->ContactsTable->Update($data);
			} else {
			   	$this->ContactsTable->Insert($data);
			   	$data['intContactID'] = $this->ContactsTable->getInsertId();
			}
			if($data['intContactID']){
				
				$delbyfields = array('intContactID'=>$data['intContactID']);
				$this->ContactsContactTable->DeleteByFields($delbyfields);
				foreach($contacts as $k=>$v){
					if(trim($v['varText']) != ''){
						$insert = array('intContactID'=>$data['intContactID'], 'varText'=>$v['varText'], 'varStaffType'=>$v['varStaffType'],);
						$this->ContactsContactTable->Insert($insert);
					}
				}
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intContactID']) && !empty($data['intContactID'])) $this->response->redirect('contacts.edit.php?intContactID='.$data['intContactID']);
		}
	}
	
	function render() {
		parent::render();
		$this->document->addValue('path', FOTO_CONTACTS_URL);	
		$this->document->addValue('data', $this->data);	
		$this->document->addValue('contacts', $this->data['contacts']);	
	}	
}

Kernel::ProcessPage(new IndexPage("contacts.edit.tpl"));