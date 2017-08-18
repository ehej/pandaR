<?php

include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.SPOEditorsTable");
Kernel::Import("classes.data.PagesTable");
Kernel::Import("classes.data.DepartureCitiesTable");

class IndexPage extends AdminPage {

	/**
	 * @var SPOEditorsTable
	 */
	var $SPOEditorsTable;
	/**
	 * @var PagesTable
	 */
	var $pagesTable;
	/**
	 * @var DepartureCitiesTable
	 */
	var $departureCitiesTable;

	var $data = false;

	function index() {
		parent::index();
		$this->setPageTitle('СПО на главной');
		$this->setBoldMenu('spoeditor');

		$this->SPOEditorsTable = new SPOEditorsTable($this->connection);
		$this->pagesTable = new PagesTable($this->connection);
		$this->departureCitiesTable = new DepartureCitiesTable($this->connection);

		$intSPOEditorID = $this->request->getNumber('intSPOEditorID', 0);
		if ($intSPOEditorID) {
			$this->data = $this->SPOEditorsTable->Get(array('intSPOEditorID' => $intSPOEditorID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет СПО с заданным ID');
				$this->response->redirect('index.php');
			}
		}
	}

	function OnSave() {		
		$data['intSPOEditorID'] = $this->request->getNumber('intSPOEditorID');
		$data['varName'] = $this->request->getString('varName');
		$data['varDepartureDate'] = $this->request->getDate('varDepartureDate');		
		$data['varValidUntilDate'] = $this->request->getDate('varValidUntilDate');
		$data['intHideAfterTheExpiration'] = $this->request->getNumber('intHideAfterTheExpiration');
		$data['isShow'] = $this->request->getNumber('isShow');
		$data['isAuthorized'] = $this->request->getNumber('isAuthorized');
		$data['varPrice'] = $this->request->getString('varPrice');
		$data['varLink'] = $this->request->getString('varLink');
		$data['varLabel'] = $this->request->getString('varLabel');
		$data['varColorBG'] = $this->request->getString('varColorBG');
		$data['varColorRO'] = $this->request->getString('varColorRO');
		
		$data['varImage'] = $this->request->getFiles('varImage');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			switch ($data['varModule']) {
				case 'link'			: { unset($data['varIdentifier']); } break;
				case 'page'			: if (!empty($data['varIdentifier'])) { unset($data['varUrl']); } break;
				case 'app_tour'		: { unset($data['varIdentifier']); $data['varUrl'] = 'app_tour.php'; } break;
				case 'search_tour'	: { unset($data['varIdentifier']); $data['varUrl'] = 'search_tour.php'; } break;
			}
			
			if ($data['varFile']['size']) {
				$data['varRealFileName'] = $data['varFile']['name'];
				$file_path = FILES_PATH;
				if (!empty($this->data['varFile'])) unlink($file_path.$this->data['varFile']);
				$file_pathinfo = pathinfo($data['varFile']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varFile']['tmp_name'], $file_path.$file_name);
				chmod($file_path.$file_name, 0777);
				$data['varFile'] = $file_name;
			} else $data['varFile'] = $this->data['varFile'];
			
			if ($data['varImage']['size']) {
				$data['varRealImageName'] = $data['varImage']['name'];
				$file_path = FILES_PATH;
				if (!empty($this->data['varImage'])) unlink($file_path.$this->data['varImage']);
				$file_pathinfo = pathinfo($data['varImage']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varImage']['tmp_name'], $file_path.$file_name);
				chmod($file_path.$file_name, 0777);
				$data['varImage'] = $file_name;
			} else $data['varImage'] = $this->data['varImage'];
			
			if (isset($data['intSPOEditorID']) && !empty($data['intSPOEditorID'])) {
				$this->SPOEditorsTable->Update($data);
			} else {
				$this->SPOEditorsTable->Insert($data);
			}

			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intSPOEditorID']) && !empty($data['intSPOEditorID'])) $this->response->redirect('spoeditor.edit.php?intSPOEditorID='.$data['intSPOEditorID']);
		}
	}

	function OnDeleteFile() {
		$data['intSPOEditorID'] = $this->request->getNumber('intSPOEditorID', 'NotEmpty');
		$data['varFile'] =	$this->request->getString('varFile', 'NotEmpty');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки');
		} else {
			if (!empty($this->data['varFile'])) {
				unlink(FILES_PATH.$this->data['varFile']);
				$this->data['varFile'] = '';
				$this->data['varRealFileName'] = '';
				$this->SPOEditorsTable->Update($this->data);
			}
		}
	}
	
	function OnDeleteImage() {
		$data['intSPOEditorID'] = $this->request->getNumber('intSPOEditorID', 'NotEmpty');
		$data['varImage'] =	$this->request->getString('varImage', 'NotEmpty');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки');
		} else {
			if (!empty($this->data['varImage'])) {
				unlink(FILES_PATH.$this->data['varImage']);
				$this->data['varImage'] = '';
				$this->data['varRealImageName'] = '';
				$this->SPOEditorsTable->Update($this->data);
			}
		}
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('departure_cities_list', $this->departureCitiesTable->GetList());
		$this->document->addValue('pages_list', $this->pagesTable->GetList());
		$this->document->addValue('data', $this->data);
	}

}

Kernel::ProcessPage(new IndexPage("spoeditor.edit.tpl"));