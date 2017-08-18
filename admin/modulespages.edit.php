<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.ModulesPagesTable");
Kernel::Import("classes.data.GallerysTable");
Kernel::Import("classes.data.BannersMainTable");
Kernel::Import("classes.data.GalleriesToModulesTable");
Kernel::Import("classes.data.BannersToModulesTable");
Kernel::Import("classes.data.ContestsTable");

class IndexPage extends AdminPage {

	/**
	 * @var ModulesPagesTable
	 */
	var $modulesPagesTable;
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
		
		$this->setPageTitle('Редактирование данных модульной страницы');
		$this->setBoldMenu('modulespages');		
		
		$this->modulesPagesTable = new ModulesPagesTable($this->connection);
		$this->gallerysTable = new GallerysTable($this->connection);
		$this->galleriesToModulesTable = new GalleriesToModulesTable($this->connection);
		$this->bannersToModulesTable = new BannersToModulesTable($this->connection);
		$this->bannersMainTable = new BannersMainTable($this->connection);
		$this->contestsTable = new ContestsTable($this->connection);
			
		$intModulePageID = $this->request->getNumber('intModulePageID', 0);
		if ($intModulePageID) {
			$this->data = $this->modulesPagesTable->Get(array('intModulePageID' => $intModulePageID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет модульной страницы с заданным ID');
				$this->response->redirect('modulespages.php');
			}
		}
	}

 	function OnSave() {
		$data['intModulePageID'] = $this->request->getNumber('intModulePageID');
		$data['varMetaTitle'] = $this->request->getString('varMetaTitle');
		$data['varMetaKeywords'] = $this->request->getString('varMetaKeywords');
		$data['varMetaDescription'] = $this->request->getString('varMetaDescription');
		$data['varPage'] = $this->request->getString('varPage');
		$data['varShowComments'] = $this->request->getString('varShowComments');
		if(!$data['varShowComments']) $data['varShowComments'] = 'no';
		$data['intContestID'] = $this->request->getNumber('intContestID');
		
		$intGalleryIDList = $this->request->Value('intGalleryID');
		$intBannersMainIDList = $this->request->Value('intBannerZoneID');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if (isset($data['intModulePageID']) && !empty($data['intModulePageID'])) {
				$this->modulesPagesTable->Update($data);
			} else {
				$this->modulesPagesTable->Insert($data);
			}
			
			$intModulePageID = $data['intModulePageID'];
			$varModule = $data['varPage'];
			$arrTmp = array('varModuleName' => $varModule, 'intModuleID' => $intModulePageID);
			$this->galleriesToModulesTable->DeleteByFields($arrTmp);	
			foreach($intGalleryIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = $data['varPage'];
				$d['intModuleID'] = $data['intModulePageID'];
				$d['intGalleryID'] = $value;
				$this->galleriesToModulesTable->Insert($d);
			}
			
			$intModulePageID = $data['intModulePageID'];
			$varModule = $data['varPage'];
			$arrTmp = array('varModuleName' => $varModule, 'intModuleID' => $intModulePageID);
			$this->bannersToModulesTable->DeleteByFields($arrTmp);	
			foreach($intBannersMainIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = $data['varPage'];
				$d['intModuleID'] = $data['intModulePageID'];
				$d['intBannerZoneID'] = $value;
				$this->bannersToModulesTable->Insert($d);
			}
			
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intModulePageID']) && !empty($data['intModulePageID'])) $this->response->redirect('modulespages.edit.php?intModulePageID='.$data['intModulePageID']);
		}
	}

	function render() {
		parent::render();
		
		$this->document->addValue('data', $this->data);	
		$this->document->addValue('contests', $this->contestsTable->GetList());	
		$this->document->addValue('galeries_list', $this->gallerysTable->GetList());
		$this->document->addValue('banners_main_list', $this->bannersMainTable->GetList());
        if($this->data['intModulePageID']!='') {
		    $this->document->addValue('galleries_to_modules', $this->galleriesToModulesTable->GetList(array('varModuleName' => $this->data['varPage'], 'intModuleID' => $this->data['intModulePageID'])));
		    $this->document->addValue('banners_to_modules', $this->bannersToModulesTable->GetList(array('varModuleName' => $this->data['varPage'], 'intModuleID' => $this->data['intModulePageID'])));
        }
	}

}

Kernel::ProcessPage(new IndexPage("modulespages.edit.tpl"));