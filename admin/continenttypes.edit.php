<?php
include_once(dirname(__FILE__)."/../classes/variables.php");
Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.ContinentTypesTable");

class IndexPage extends AdminPage {

	/**
	 * 
	 * @var ContinentTypesTable
	 */
	var $continentTypesTable;	
	var $data = false;
	var $intTypeID;

	function index() {
		parent::index();
		$this->setPageTitle('Редактирование данных типа континента');
		$this->setBoldMenu('continenttypes');		
		$this->continentTypesTable = new ContinentTypesTable($this->connection);		
		$this->intTypeID = $this->request->getNumber('intTypeID', 0);
		if ($this->intTypeID) {
			$this->data = $this->continentTypesTable->Get(array('intTypeID'=>$this->intTypeID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет типа континента с заданным ID');
				$this->response->redirect('continenttypes.php');
			}
		}
	}
		
 	function OnSave() {
		$data['intTypeID'] = $this->request->getNumber('intTypeID');
		$data['varName'] =	$this->request->getString('varName', 'NotEmpty');
		$data['varLogo'] = $this->request->getFiles('varLogo', 'NotEmpty');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if ($data['varLogo']['size']) {
				$data['varRealLogoName'] = $data['varLogo']['name'];
				$file_path = FILES_PATH;
				if (!empty($this->data['varLogo'])) unlink($file_path.$this->data['varLogo']);
				$file_pathinfo = pathinfo($data['varLogo']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varLogo']['tmp_name'], $file_path.$file_name);
				chmod($file_path.$file_name, 0777);
				$data['varLogo'] = $file_name;
			} else $data['varLogo'] = $this->data['varLogo'];
			
			if (isset($data['intTypeID']) && !empty($data['intTypeID'])) {
				$this->continentTypesTable->Update($data);
			} else {
				$this->continentTypesTable->Insert($data);
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intTypeID']) && !empty($data['intTypeID'])) $this->response->redirect('continenttypes.edit.php?intTypeID='.$data['intTypeID']);
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
				$this->continentTypesTable->update($this->data);
			}
		}
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('data', $this->data);		
	}

}

Kernel::ProcessPage(new IndexPage("continenttypes.edit.tpl"));