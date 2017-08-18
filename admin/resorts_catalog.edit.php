<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.GallerysTable");
Kernel::Import("classes.data.GalleriesToModulesTable");
Kernel::Import("classes.data.BannersMainTable");
Kernel::Import("classes.data.BannersToModulesTable");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.TblCountryTable");
Kernel::Import("classes.data.TblRegionTable");

class IndexPage extends AdminPage {

	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	/**
	 * @var GallerysTable
	 */
	var $gallerysTable;
	/**
	 * @var GalleriesToModulesTable
	 */
	var $galleriesToModulesTable;
	/**
	 * @var ResortsTable
	 */
	var $ResortsTable;
	/**
	 * @var TblCountryTable
	 */
	var $tblCountryTable;
	/**
	 * @var TblRegionTable
	 */
	var $tblRegionTable;
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
		
		$this->setPageTitle('Редактирование данных курорта');
		$this->setBoldMenu('resortsCatalog');		
		
		$this->countriesTable = new CountriesTable($this->connection);
		$this->ResortsTable = new ResortsTable($this->connection);
		$this->gallerysTable = new GallerysTable($this->connection);
		$this->galleriesToModulesTable = new GalleriesToModulesTable($this->connection);
		$this->bannersToModulesTable = new BannersToModulesTable($this->connection);
		$this->bannersMainTable = new BannersMainTable($this->connection);
		
		$intResortID = $this->request->getNumber('intResortID', 0);
		if ($intResortID) {
			$this->data = $this->ResortsTable->Get(array('intResortID' => $intResortID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет курорта с заданным ID');
				$this->response->redirect('resorts_catalog.php');
			}
		}
	}

 	function OnSave() {
		$data['intResortID'] = $this->request->getNumber('intResortID');
		$data['intCountryID'] = $this->request->getNumber('intCountryID', 'NotEmpty');
		$data['varName'] =	$this->request->getString('varName', 'NotEmpty');
		$data['varUrlAlias'] = $this->request->getString('varUrlAlias');
		$data['varMetaTitle'] = $this->request->getString('varMetaTitle');
		$data['varMetaKeywords'] = $this->request->getString('varMetaKeywords');
		$data['varMetaDescription'] = $this->request->getString('varMetaDescription');
		$data['varShortDescription'] = $this->request->getString('varShortDescription', 'NotEmpty');
		$data['varDescription'] = $this->request->getString('varDescription', 'NotEmpty');
		$data['varShowComments'] = $this->request->getString('varShowComments');
		$data['isActive'] = $this->request->getNumber('isActive');
		$data['isViewInMenu'] = $this->request->getNumber('isViewInMenu');
		$data['isAllwaysOpen'] = $this->request->getNumber('isAllwaysOpen');
		if(!$data['varShowComments']) $data['varShowComments'] = 'no';
		$intGalleryIDList = $this->request->Value('intGalleryID');
		$intBannersMainIDList = $this->request->Value('intBannerZoneID');
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			
			if (isset($data['intResortID']) && !empty($data['intResortID'])) {
				$this->ResortsTable->Update($data);
			} else {
				$this->ResortsTable->Insert($data);
				$data['intResortID'] = $this->ResortsTable->getInsertId();
			}
			
			$intResortID = $data['intResortID'];
			$arrTmp = array('varModuleName' => 'resorts', 'intModuleID' => $intResortID);
			$this->galleriesToModulesTable->DeleteByFields($arrTmp);	
			foreach($intGalleryIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'resorts';
				$d['intModuleID'] = $data['intResortID'];
				$d['intGalleryID'] = $value;
				$this->galleriesToModulesTable->Insert($d);
			}
			$intResortID = $data['intResortID'];
			$arrTmp = array('varModuleName' => 'resorts', 'intModuleID' => $intResortID);
			$this->bannersToModulesTable->DeleteByFields($arrTmp);	
			foreach($intBannersMainIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'resorts';
				$d['intModuleID'] = $data['intResortID'];
				$d['intBannerZoneID'] = $value;
				$this->bannersToModulesTable->Insert($d);
			}
			
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intResortID']) && !empty($data['intResortID'])) $this->response->redirect('resorts_catalog.edit.php?intResortID='.$data['intResortID']);
		}
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('data', $this->data);		
		$countries = $this->countriesTable->getListIDsNames();
		$this->document->addValue('countries_list', $countries);		
		$this->document->addValue('json_countries_list', json_encode($countries));
		$resorts = $this->ResortsTable->getListIDsNames();
		$this->document->addValue('json_resorts_list', json_encode($resorts));
		$this->document->addValue('banners_main_list', $this->bannersMainTable->GetList());

		$this->document->addValue('galeries_list', $this->gallerysTable->GetList());
        if($this->data['intResortID']!='') {
            $this->document->addValue('banners_to_modules', $this->bannersToModulesTable->GetList(array('varModuleName' => 'resorts', 'intModuleID' => $this->data['intResortID'])));
		    $this->document->addValue('galleries_to_modules', $this->galleriesToModulesTable->GetList(array('varModuleName' => 'resorts', 'intModuleID' => $this->data['intResortID'])));
        }
	}

}

Kernel::ProcessPage(new IndexPage("resorts_catalog.edit.tpl"));