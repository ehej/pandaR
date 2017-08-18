<?php
include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.StaffsTable");
Kernel::Import("classes.data.StaffsContactTable");
Kernel::Import("classes.data.StaffsRelationCoutrysTable");
Kernel::Import("classes.data.StaffsRelationTypeTable");
Kernel::Import("classes.data.StaffsTypeTable");
Kernel::Import("classes.data.CountriesTable");

class IndexPage extends AdminPage {

	public $StaffsTable;
	public $StaffsContactTable;
	public $StaffsRelationCoutrysTable;
	public $StaffsRelationTypeTable;
	public $countriesTable;
	public $StaffsTypeTable;
	public $data;
	
	function index() {
		parent::index();
		
		$this->setBoldMenu('staffs');
		
		$this->StaffsTable 					= new StaffsTable($this->connection);
		$this->StaffsContactTable 			= new StaffsContactTable($this->connection);
		$this->StaffsRelationCoutrysTable 	= new StaffsRelationCountryTable($this->connection);
		$this->StaffsRelationTypeTable 		= new StaffsRelationTypeTable($this->connection);
		$this->StaffsTypeTable 				= new StaffsTypeTable($this->connection);
		$this->countriesTable 				= new CountriesTable($this->connection);
		
		$this->intStaffID = $this->request->getNumber('intStaffID', 0);
		
		if ($this->intStaffID) {
			$this->setPageTitle('Редактирование сотрудника');
			$this->data = $this->StaffsTable->Get(array('intStaffID' => $this->intStaffID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет сотрудника с заданным ID');
				$this->response->redirect('staffs.php');
			}
			$this->data['contacts'] = $this->StaffsContactTable->GetList(array('intStaffID'=>$this->data['intStaffID']), array('intContactID' => 'ASC'));
		
			$relation = $this->StaffsRelationCoutrysTable->GetList(array('intStaffID'=>$this->data['intStaffID']));
			foreach ($relation as $value) {
				$this->data['relation'][] = $value['intCountry']; 
			}
			$relation_type = $this->StaffsRelationTypeTable->GetList(array('intStaffID'=>$this->data['intStaffID']));
			foreach ($relation_type as $value) {
				$this->data['relation_type'][] = $value['intTypeID']; 
			}
			
		}else{
			$this->setPageTitle('Добавление сотрудника');
		}
		
	}
	
	function OnSave() {
		$data['intStaffID'] = $this->request->getNumber('intStaffID', 0);
		$data['intTypeID'] 	= $this->request->getNumber('intTypeID');
		$data['varName'] 	= $this->request->getString('varName', 'NotEmpty');	
		$data['varView'] 	= $this->request->getString('varView', 'NotEmpty');	
		$data['varPost'] 	= $this->request->getString('varPost');	
		$data['varInfo'] 	= $this->request->getString('varInfo');	
		$varFoto 			= $this->request->getFiles('varFoto');
		$varFoto_Clear 		= $this->request->getNumber('varFoto_Clear', 0);
		$contacts 			= $this->request->Value('contacts');	
		$contacts_type 		= $this->request->Value('contacts_type');	
		foreach ($contacts as $key => $value) {
			$tmp[$key] = array('varText'=>$value, 'varStaffType'=>$contacts_type[$key]);
		}
		$contacts = $tmp;
		$countries 			= $this->request->Value('countries');	
		$types 				= $this->request->Value('intTypeID');	
		
		if ($varFoto['size']) {
            $file_path = FOTO_STAFFS;         
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
			$this->data['relation'] = $countries;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			
			if (!empty($data['intStaffID'])) {
			   	$this->StaffsTable->Update($data);
			} else {
			   	$this->StaffsTable->Insert($data);
			   	$data['intStaffID'] = $this->StaffsTable->getInsertId();
			}
			if($data['intStaffID']){
				
				$delbyfields = array('intStaffID'=>$data['intStaffID']);
				
				$this->StaffsRelationCoutrysTable->DeleteByFields($delbyfields);
				foreach($countries as $k=>$v){
					$insert = array('intStaffID'=>$data['intStaffID'], 'intCountry'=>$v);
					$this->StaffsRelationCoutrysTable->Insert($insert);
				}
				$delbyfields = array('intStaffID'=>$data['intStaffID']);
				$this->StaffsRelationTypeTable->DeleteByFields($delbyfields);
				foreach($types as $k=>$v){
					$insert = array('intStaffID'=>$data['intStaffID'], 'intTypeID'=>$v);
					$this->StaffsRelationTypeTable->Insert($insert);
				}
				$delbyfields = array('intStaffID'=>$data['intStaffID']);
				$this->StaffsContactTable->DeleteByFields($delbyfields);
				foreach($contacts as $k=>$v){
					if(trim($v['varText']) != ''){
						$insert = array('intStaffID'=>$data['intStaffID'], 'varText'=>$v['varText'], 'varStaffType'=>$v['varStaffType'],);
						$this->StaffsContactTable->Insert($insert);
					}
				}
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intStaffID']) && !empty($data['intStaffID'])) $this->response->redirect('staffs.edit.php?intStaffID='.$data['intStaffID']);
		}
	}
	
	function render() {
		parent::render();

		$this->document->addValue('path', FOTO_STAFFS_URL);	
		$this->document->addValue('data', $this->data);	
		$this->document->addValue('contacts', $this->data['contacts']);	
		
		$this->document->addValue('relation', ($this->data['relation']?$this->data['relation']:array()));
		$this->document->addValue('relation_type', ($this->data['relation_type']?$this->data['relation_type']:array()));
		
		$countries = $this->countriesTable->getListIDsNames();
		$this->document->addValue('countries', $countries);
		
		$pages = $this->StaffsTypeTable->GetList(null, array('intOrdering'=>'ASC'));
		$this->document->addValue('type_list', $pages);
	}	
}

Kernel::ProcessPage(new IndexPage("staffs.edit.tpl"));