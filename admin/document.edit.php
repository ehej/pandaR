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
		
		$this->setPageTitle('Редактирование документа');
		$this->setBoldMenu('document');		
		$this->DocumentTable = new DocumentTable($this->connection);
		$this->DocumentCategoryTable = new DocumentCategoryTable($this->connection);
			
		$intDocumentID = $this->request->getNumber('intDocumentID', 0);
		if ($intDocumentID) {
			$this->data = $this->DocumentTable->Get(array('intDocumentID' => $intDocumentID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет документа с заданным ID');
				$this->response->redirect('document.php');
			}
		}
	}

 	function OnSave() {
		$data['intDocumentID'] 			= $this->request->getNumber('intDocumentID');
		$data['intCategoryID'] 			= $this->request->getNumber('intCategoryID');
		$data['varName'] 				= $this->request->getString('varName', 'NotEmpty');
		$data['varDescription'] 		= $this->request->getString('varDescription');
		$data['intOrdering'] 			= $this->request->getString('intOrdering');
		$data['isActive']				= $this->request->getString('isActive');
		$data['varFileName']			= $this->request->getFiles ('varFileName');

		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			$file_path = FILES_PATH;
			if ($data['varFileName']['size']) {
				if (!empty($this->data['varFileName'])) unlink($file_path.$this->data['varFileName']);
				$file_pathinfo = pathinfo($data['varFileName']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
								
				$dir = $file_path.substr($file_name, 0, 3)."/";
				if ( ! is_dir($dir)){
					if ( ! mkdir($dir, 0777)){
						echo $data['messages'][] = 'Не удалось создать директорию для загрузки файла';
					}else{
						chmod($dir, 0777);
					}
				}
				move_uploaded_file($data['varFileName']['tmp_name'], $dir.$file_name);
				chmod($dir.$file_name, 0777);
				$data['varFileNameReal'] = $data['varFileName']['name'];
				$data['varFileName'] = $file_name;
				$data['varFile'] = $file_pathinfo['extension'];
				$data['varDate'] = time();
			} else {
				$data['varFileName'] = $this->data['varFileName'];
				$data['varFile'] = $this->data['varFile'];
				$data['varFileNameReal'] = $this->data['varFileNameReal'];
			}
			
			if (isset($data['intDocumentID']) && !empty($data['intDocumentID'])) {
				$this->DocumentTable->Update($data);
			} else {
				$data['varDate'] = time();
				$this->DocumentTable->Insert($data);
				$data['intDocumentID'] = $this->DocumentTable->getInsertId();
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intDocumentID']) && !empty($data['intDocumentID'])) $this->response->redirect('document.edit.php?intDocumentID='.$data['intDocumentID']);
		}
	}

	function OnDeleteFile() {
		$data['intDocumentID'] = $this->request->getNumber('intDocumentID', 'NotEmpty');
		
		if($this->request->getString('varFileName') != ''){
			$data['varFileName'] =	$this->request->getString('varFileName');
		}

		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки');
		} else {
			if (!empty($this->data['varFileName'])) {
				if($this->request->getString('varFileName') != ''){
					unlink(FILES_PATH.substr($this->data['varFileName'],0,3).'/'.$this->data['varFileName']);
					$this->data['varFileName'] = '';
					$this->data['varFile'] = '';
					$this->data['varFileNameReal'] = '';
				}
				$this->DocumentTable->Update($this->data);
			}
			$this->response->redirect('document.edit.php?intDocumentID='.$data['intDocumentID']);
		}
		
	}

	
	function render() {
		parent::render();
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('data', $this->data);		
		
		$this->document->addValue('category', $this->DocumentCategoryTable->GetList());
	}

}

Kernel::ProcessPage(new IndexPage("document.edit.tpl"));