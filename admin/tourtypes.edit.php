<?php
include_once(dirname(__FILE__)."/../classes/variables.php");
Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.TourTypesTable");

class IndexPage extends AdminPage {

	var $tourtypesTable;	
	var $data = false;
	var $intTypeID;

	function index() {
		parent::index();
		$this->setPageTitle('Редактирование данных типа тура');
		$this->setBoldMenu('tourtypes');		
		$this->tourtypesTable = new TourTypesTable($this->connection);		
		$this->intTypeID = $this->request->getNumber('intTypeID', 0);
		if ($this->intTypeID) {
			$this->data = $this->tourtypesTable->Get(array('intTypeID'=>$this->intTypeID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет типа тура с заданным ID');
				$this->response->redirect('tourtypes.php');
			}
		}
	}
		
 	function OnSave() {
		$data['intTypeID'] = $this->request->getNumber('intTypeID');
		$data['varName'] =	$this->request->getString('varName', 'NotEmpty');
//		$data['varLogo'] = $this->request->getFiles('varLogo', 'NotEmpty');
		$data['intActive'] = $this->request->getNumber('intActive');
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if ($data['varLogo']['size']) {
				$data['varRealLogoName'] = $data['varLogo']['name'];
				//$file_path = FILESTORAGE_PATH.'files/';
				$file_path = FILES_PATH;
				if (!empty($this->data['varLogo'])) unlink($file_path.$this->data['varLogo']);
				$file_pathinfo = pathinfo($data['varLogo']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varLogo']['tmp_name'], $file_path.$file_name);
				chmod($file_path.$file_name, 0777);
				$data['varLogo'] = $file_name;
			} else $data['varLogo'] = $this->data['varLogo'];
			
			if (isset($data['intTypeID']) && !empty($data['intTypeID'])) {
				$this->tourtypesTable->Update($data);
			} else {
				$this->tourtypesTable->Insert($data);
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intTypeID']) && !empty($data['intTypeID'])) $this->response->redirect('tourtypes.edit.php?intTypeID='.$data['intTypeID']);
		}
	}

	function OnDeleteFile() {
		$data['intTypeID'] = $this->request->getNumber('intTypeID', 'NotEmpty');
		$data['varLogo'] =	$this->request->getString('varLogo', 'NotEmpty');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки');
		} else {
			if (!empty($this->data['varLogo'])) {
				unlink(FILES_PATH.$this->data['varLogo']);
				$this->data['varLogo'] = '';
				$this->data['varRealLogoName'] = '';
				$this->tourtypesTable->update($this->data);
			}
		}
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('data', $this->data);		
	}

}

Kernel::ProcessPage(new IndexPage("tourtypes.edit.tpl"));