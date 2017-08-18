<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.AkciiTable");
Kernel::Import("classes.data.GallerysTable");
Kernel::Import("classes.data.BannersMainTable");
Kernel::Import("classes.data.GalleriesToModulesTable");
Kernel::Import("classes.data.BannersToModulesTable");
Kernel::Import("classes.data.ContestsTable");

class IndexPage extends AdminPage {

	/**
	 * 
	 * @var akciiTable
	 */
	var $akciiTable;
	/**
	 * @var GallerysTable
	 */
	var $gallerysTable;
	/**
	 * @var GalleriesToModulesTable
	 */
	var $galleriesToModulesTable;
	/**
	 * @var BannersToModulesTable
	 */
	var $bannersToModulesTable;
	/**
	 * @var BannersMainTable
	 */
	var $bannersMainTable;
	/**
	 * @var ContestsTable
	 */
	var $contestsTable;
	
	var $data = false;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных акции');
		$this->setBoldMenu('akcii');		
		
		$this->akciiTable = new AkciiTable($this->connection);	
		$this->gallerysTable = new GallerysTable($this->connection);
		$this->galleriesToModulesTable = new GalleriesToModulesTable($this->connection);
		$this->bannersToModulesTable = new BannersToModulesTable($this->connection);
		$this->bannersMainTable = new BannersMainTable($this->connection);
		$this->contestsTable = new ContestsTable($this->connection);
		
		$intAkciyID = $this->request->getNumber('intAkciyID', 0);
		if ($intAkciyID) {
			$this->data = $this->akciiTable->Get(array('intAkciyID' => $intAkciyID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет акции с заданным ID');
				$this->response->redirect('akcii.php');
			}
		}
	}

 	function OnSave() {
		$data['intAkciyID'] = $this->request->getNumber('intAkciyID');
		$data['varTitle'] =	$this->request->getString('varTitle', 'NotEmpty');
		$data['varAnnotation'] = $this->request->getString('varAnnotation');
		$data['varMetaKeywords'] = $this->request->getString('varMetaKeywords');
		$data['varMetaDescription'] = $this->request->getString('varMetaDescription');
		$data['intContestID'] = $this->request->getNumber('intContestID');
		$data['varDescription'] = $this->request->getString('varDescription', 'NotEmpty');
		$data['intOnlyAuthorized'] = $this->request->getNumber('intOnlyAuthorized', 0);
		$data['intActive'] = $this->request->getNumber('intActive', 0);
		$data['varShowComments'] = $this->request->getString('varShowComments');
		if(!$data['varShowComments']) $data['varShowComments'] = 'no';
		$data['varDate'] = time();
		$intGalleryIDList = $this->request->Value('intGalleryID');
		$intBannersMainIDList = $this->request->Value('intBannerZoneID');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if (isset($data['intAkciyID']) && !empty($data['intAkciyID'])) {
				$this->akciiTable->Update($data);
			} else {
				$this->akciiTable->Insert($data);
			}
			
			$intAkciyID = $data['intAkciyID'];
			$arrTmp = array('varModuleName' => 'ackii', 'intModuleID' => $intAkciyID);
			$this->galleriesToModulesTable->DeleteByFields($arrTmp);	
			foreach($intGalleryIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'akcii';
				$d['intModuleID'] = $data['intAkciyID'];
				$d['intGalleryID'] = $value;
				$this->galleriesToModulesTable->Insert($d);
			}
			
			$intAkciyID = $data['intAkciyID'];
			$arrTmp = array('varModuleName' => 'akcii', 'intModuleID' => $intAkciyID);
			$this->bannersToModulesTable->DeleteByFields($arrTmp);	
			foreach($intBannersMainIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'akcii';
				$d['intModuleID'] = $data['intAkciyID'];
				$d['intBannerZoneID'] = $value;
				$this->bannersToModulesTable->Insert($d);
			}
			
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intAkciyID']) && !empty($data['intAkciyID'])) $this->response->redirect('akcii.edit.php?intAkciyID='.$data['intAkciyID']);
		}
	}

	function render() {
		parent::render();
		
		$this->document->addValue('data', $this->data);
		$this->document->addValue('contests', $this->contestsTable->GetList());	
		$this->document->addValue('galeries_list', $this->gallerysTable->GetList());
		$this->document->addValue('banners_main_list', $this->bannersMainTable->GetList());
        if($this->data['intAkciyID']!='') {
		    $this->document->addValue('galleries_to_modules', $this->galleriesToModulesTable->GetList(array('varModuleName' => 'akcii', 'intModuleID' => $this->data['intAkciyID'])));
		    $this->document->addValue('banners_to_modules', $this->bannersToModulesTable->GetList(array('varModuleName' => 'akcii', 'intModuleID' => $this->data['intAkciyID'])));
        }
	}

}

Kernel::ProcessPage(new IndexPage("akcii.edit.tpl"));