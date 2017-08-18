<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.AdvCountriesTable");
Kernel::Import("classes.data.AdvResortsTable");
Kernel::Import("classes.data.AdvResortsContentTable");
Kernel::Import("classes.data.GallerysTable");
Kernel::Import("classes.data.GalleriesToModulesTable");
Kernel::Import("classes.data.BannersMainTable");
Kernel::Import("classes.data.BannersToModulesTable");

class IndexPage extends AdminPage {

	/**
	 * @var AdvCountriesTable
	 */
	var $AdvCountriesTable;
	/**
	 * @var AdvResortsTable
	 */
	var $AdvResortsTable;
	/**
	 * @var AdvResortsContentTable
	 */
	var $AdvResortsContentTable;
	
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
	
	var $data = false;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование информации о достопримечательности');
		$this->setBoldMenu('resorts_content_catalog_adv');		
		
		$this->AdvCountriesTable = new AdvCountriesTable($this->connection);
		$this->AdvResortsTable = new AdvResortsTable($this->connection);
		$this->AdvResortsContentTable = new AdvResortsContentTable($this->connection);
		$this->gallerysTable = new GallerysTable($this->connection);
		$this->galleriesToModulesTable = new GalleriesToModulesTable($this->connection);
		$this->bannersToModulesTable = new BannersToModulesTable($this->connection);
		$this->bannersMainTable = new BannersMainTable($this->connection);
		
		$intResortContentID = $this->request->getNumber('intResortContentID', 0);
		if ($intResortContentID) {
			$this->data = $this->AdvResortsContentTable->Get(array('intResortContentID' => $intResortContentID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет достопримечательности с заданным ID');
				$this->response->redirect('resorts_content_catalog_adv.php');
			}
		}
	}

 	function OnSave() {
		$data['intResortContentID'] 	= $this->request->getNumber('intResortContentID');
		$data['intResortID'] 			= $this->request->getNumber('intResortID', 'NotEmpty');
		$data['varName'] 				= $this->request->getString('varName', 'NotEmpty');
		$data['varUrlAlias'] 			= $this->request->getString('varUrlAlias', 'NotEmpty');
		$data['varPageTitle'] 			= $this->request->getString('varPageTitle');
		$data['varPageKeywords']		= $this->request->getString('varPageKeywords');
		$data['varPageDescription'] 	= $this->request->getString('varPageDescription');
		$data['varH1Text'] 				= $this->request->getString('varH1Text');
		$data['varContent'] 			= $this->request->getString('varContent', 'NotEmpty');
		$data['intOrdering'] 			= $this->request->getNumber('intOrdering');
		$data['isActive'] 				= $this->request->getNumber('isActive');
		
		$intGalleryIDList = $this->request->Value('intGalleryID');
		$intBannersMainIDList = $this->request->Value('intBannerZoneID');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			

			if (isset($data['intResortContentID']) && !empty($data['intResortContentID'])) {
				$this->AdvResortsContentTable->Update($data);
			} else {
				$this->AdvResortsContentTable->Insert($data);
				$data['intResortContentID'] = $this->AdvResortsContentTable->getInsertId();
			}

			$intResortContentID = $data['intResortContentID'];
			$arrTmp = array('varModuleName' => 'adv_resorts_content', 'intModuleID' => $intResortContentID);
			$this->galleriesToModulesTable->DeleteByFields($arrTmp);	
			foreach($intGalleryIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'adv_resorts_content';
				$d['intModuleID'] = $data['intResortContentID'];
				$d['intGalleryID'] = $value;
				$this->galleriesToModulesTable->Insert($d);
			}
			$intResortContentID = $data['intResortContentID'];
			$arrTmp = array('varModuleName' => 'adv_resorts_content', 'intModuleID' => $intResortContentID);
			$this->bannersToModulesTable->DeleteByFields($arrTmp);	
			foreach($intBannersMainIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'adv_resorts_content';
				$d['intModuleID'] = $data['intResortContentID'];
				$d['intBannerZoneID'] = $value;
				$this->bannersToModulesTable->Insert($d);
			}
			
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intResortContentID']) && !empty($data['intResortContentID'])) $this->response->redirect('resorts_content_catalog_adv.edit.php?intResortContentID='.$data['intResortContentID']);
		}
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('data', $this->data);		
		$resorts = $this->AdvResortsTable->getListIDsNames();
		$this->document->addValue('resorts_list', $resorts);
		
		$this->document->addValue('banners_main_list', $this->bannersMainTable->GetList());
        $this->document->addValue('galeries_list', $this->gallerysTable->GetList());
        if($this->data['intResortContentID']!='') {
		    $this->document->addValue('banners_to_modules', $this->bannersToModulesTable->GetList(array('varModuleName' => 'adv_resorts_content', 'intModuleID' => $this->data['intResortContentID'])));
            $this->document->addValue('galleries_to_modules', $this->galleriesToModulesTable->GetList(array('varModuleName' => 'adv_resorts_content', 'intModuleID' => $this->data['intResortContentID'])));
        }
	}

}

Kernel::ProcessPage(new IndexPage("resorts_content_catalog_adv.edit.tpl"));