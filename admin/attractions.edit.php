<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.AttractionsTable");
Kernel::Import("classes.data.GallerysTable");
Kernel::Import("classes.data.GalleriesToModulesTable");
Kernel::Import("classes.data.BannersMainTable");
Kernel::Import("classes.data.BannersToModulesTable");

class IndexPage extends AdminPage {

	/**
	 * @var CountriesTable
	 */
	var $CountriesTable;
	/**
	 * @var ResortsTable
	 */
	var $ResortsTable;
	/**
	 * @var AttractionsTable
	 */
	var $AttractionsTable;
	
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
		$this->setBoldMenu('attractions');		
		
		$this->CountriesTable = new CountriesTable($this->connection);
		$this->ResortsTable = new ResortsTable($this->connection);
		$this->AttractionsTable = new AttractionsTable($this->connection);
		$this->gallerysTable = new GallerysTable($this->connection);
		$this->galleriesToModulesTable = new GalleriesToModulesTable($this->connection);
		$this->bannersToModulesTable = new BannersToModulesTable($this->connection);
		$this->bannersMainTable = new BannersMainTable($this->connection);
		
		$intAttractionID = $this->request->getNumber('intAttractionID', 0);
		if ($intAttractionID) {
			$this->data = $this->AttractionsTable->Get(array('intAttractionID' => $intAttractionID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет достопримечательности с заданным ID');
				$this->response->redirect('attractions.php');
			}
		}
	}

 	function OnSave() {
		$data['intAttractionID'] 		= $this->request->getNumber('intAttractionID');
		$data['intCountryID'] 			= $this->request->getNumber('intCountryID', 'NotEmpty');
		$data['intResortID'] 			= $this->request->getNumber('intResortID');
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

			if (isset($data['intAttractionID']) && !empty($data['intAttractionID'])) {
				$this->AttractionsTable->Update($data);
			} else {
				$this->AttractionsTable->Insert($data);
			}

			$intAttractionID = $data['intAttractionID'];
			$arrTmp = array('varModuleName' => 'attractions', 'intModuleID' => $intAttractionID);
			$this->galleriesToModulesTable->DeleteByFields($arrTmp);	
			foreach($intGalleryIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'attractions';
				$d['intModuleID'] = $data['intAttractionID'];
				$d['intGalleryID'] = $value;
				$this->galleriesToModulesTable->Insert($d);
			}
			$intAttractionID = $data['intAttractionID'];
			$arrTmp = array('varModuleName' => 'attractions', 'intModuleID' => $intAttractionID);
			$this->bannersToModulesTable->DeleteByFields($arrTmp);	
			foreach($intBannersMainIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'attractions';
				$d['intModuleID'] = $data['intAttractionID'];
				$d['intBannerZoneID'] = $value;
				$this->bannersToModulesTable->Insert($d);
			}
			
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intAttractionID']) && !empty($data['intAttractionID'])) $this->response->redirect('attractions.edit.php?intAttractionID='.$data['intAttractionID']);
		}
	}
	
	function render() {
		parent::render();
		$this->document->addValue('data', $this->data);		
		$resorts = $this->ResortsTable->GetList(null, array('varName'=>'ASC'));
		$this->document->addValue('resorts_list', $resorts);
		$countries = $this->CountriesTable->GetList(null, array('varName'=>'ASC'));
		$this->document->addValue('countries_list', $countries);
		
		$this->document->addValue('banners_main_list', $this->bannersMainTable->GetList());

		$this->document->addValue('galeries_list', $this->gallerysTable->GetList());
        if($this->data['intAttractionID']!='') {
            $this->document->addValue('banners_to_modules', $this->bannersToModulesTable->GetList(array('varModuleName' => 'attractions', 'intModuleID' => $this->data['intAttractionID'])));
		    $this->document->addValue('galleries_to_modules', $this->galleriesToModulesTable->GetList(array('varModuleName' => 'attractions', 'intModuleID' => $this->data['intAttractionID'])));
        }
	}

}

Kernel::ProcessPage(new IndexPage("attractions.edit.tpl"));