<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.GallerysTable");
Kernel::Import("classes.data.GalleriesToModulesTable");
Kernel::Import("classes.data.BannersMainTable");
Kernel::Import("classes.data.BannersToModulesTable");
Kernel::Import("classes.data.RegionsTable");
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
	 * @var RegionsTable
	 */
	var $regionsTable;
	/**
	 * @var ResortsTable
	 */
	var $resortsTable;
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
		
		$this->setPageTitle('Редактирование данных региона');
		$this->setBoldMenu('regionsCatalog');		
		
		$this->countriesTable = new CountriesTable($this->connection);
		$this->resortsTable = new ResortsTable($this->connection);
		$this->regionsTable = new RegionsTable($this->connection);
		$this->gallerysTable = new GallerysTable($this->connection);
		$this->galleriesToModulesTable = new GalleriesToModulesTable($this->connection);
		$this->tblCountryTable = new TblCountryTable($this->mssql_connection);
		$this->tblRegionTable = new TblRegionTable($this->mssql_connection);
		$this->bannersToModulesTable = new BannersToModulesTable($this->connection);
		$this->bannersMainTable = new BannersMainTable($this->connection);
		
		$intRegionID = $this->request->getNumber('intRegionID', 0);
		if ($intRegionID) {
			$this->data = $this->regionsTable->Get(array('intRegionID' => $intRegionID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет региона с заданным ID');
				$this->response->redirect('regions_catalog.php');
			}
		}
	}

 	function OnSave() {
		$data['intRegionID'] = $this->request->getNumber('intRegionID');
		$data['intResortID'] = $this->request->getNumber('intResortID', 'NotEmpty');
		$data['varName'] =	$this->request->getString('varName', 'NotEmpty');
		$data['varUrlAlias'] = $this->request->getString('varUrlAlias');
		$data['varMetaTitle'] = $this->request->getString('varMetaTitle');
		$data['varMetaKeywords'] = $this->request->getString('varMetaKeywords');
		$data['varMetaDescription'] = $this->request->getString('varMetaDescription');
		$data['varDescription'] = $this->request->getString('varDescription', 'NotEmpty');
		$data['varShowComments'] = $this->request->getString('varShowComments');
		$data['isActive'] = $this->request->getNumber('isActive');
		$data['isViewInMenu'] = $this->request->getNumber('isViewInMenu');
		if(!$data['varShowComments']) $data['varShowComments'] = 'no';
		$intGalleryIDList = $this->request->Value('intGalleryID');
		$intBannersMainIDList = $this->request->Value('intBannerZoneID');
		$data['intMTCityID'] = $this->request->getNumber('intMTCityID');
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			

			if (isset($data['intRegionID']) && !empty($data['intRegionID'])) {
				$this->regionsTable->Update($data);
			} else {
				$this->regionsTable->Insert($data);
			}

			$intRegionID = $data['intRegionID'];
			$arrTmp = array('varModuleName' => 'regions', 'intModuleID' => $intRegionID);
			$this->galleriesToModulesTable->DeleteByFields($arrTmp);	
			foreach($intGalleryIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'regions';
				$d['intModuleID'] = $data['intRegionID'];
				$d['intGalleryID'] = $value;
				$this->galleriesToModulesTable->Insert($d);
			}
			$intRegionID = $data['intRegionID'];
			$arrTmp = array('varModuleName' => 'regions', 'intModuleID' => $intRegionID);
			$this->bannersToModulesTable->DeleteByFields($arrTmp);	
			foreach($intBannersMainIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'regions';
				$d['intModuleID'] = $data['intRegionID'];
				$d['intBannerZoneID'] = $value;
				$this->bannersToModulesTable->Insert($d);
			}
			
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intRegionID']) && !empty($data['intRegionID'])) $this->response->redirect('regions_catalog.edit.php?intRegionID='.$data['intRegionID']);
		}
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('data', $this->data);		
		$countries = $this->countriesTable->getListIDsNames();
		$this->document->addValue('countries_list', $countries);		
		$this->document->addValue('json_countries_list', json_encode($countries));
		
		$resorts = $this->resortsTable->GetList(null, array('varName'=>'ASC'));
		$this->document->addValue('resorts_list', $resorts);		
		$this->document->addValue('json_resorts_list', json_encode($resorts));
		
		$regions = $this->regionsTable->getListIDsNames(null, array('varName'=>'ASC'));
		$this->document->addValue('json_regions_list', json_encode($regions));
		$this->document->addValue('banners_main_list', $this->bannersMainTable->GetList());

		$this->document->addValue('galeries_list', $this->gallerysTable->GetList());
        if($this->data['intRegionID']!='') {
            $this->document->addValue('banners_to_modules', $this->bannersToModulesTable->GetList(array('varModuleName' => 'regions', 'intModuleID' => $this->data['intRegionID'])));
		    $this->document->addValue('galleries_to_modules', $this->galleriesToModulesTable->GetList(array('varModuleName' => 'regions', 'intModuleID' => $this->data['intRegionID'])));
        }
		$tmp = $this->tblCountryTable->GetList();
		$arr = array();
		foreach ($tmp as $key => $value) {
			$arr[$key]['CN_KEY'] = iconv('WINDOWS-1251', 'UTF-8', $value['CN_KEY']);
			$arr[$key]['CN_NAME'] = iconv('WINDOWS-1251', 'UTF-8', $value['CN_NAME']);
		}
		
		$this->document->addValue('tbl_countries_list', $arr);
		
		$tmp = $this->tblRegionTable->GetList();
		$arr = array();
		foreach ($tmp as $key => $value) {
			$arr[$key]['CT_KEY'] = iconv('WINDOWS-1251', 'UTF-8', $value['CT_KEY']); // id региона
			$arr[$key]['CT_CNKEY'] = iconv('WINDOWS-1251', 'UTF-8', $value['CT_CNKEY']); // id страны
			$arr[$key]['CT_NAME'] = iconv('WINDOWS-1251', 'UTF-8', $value['CT_NAME']);
		}
		
		$this->document->addValue('tbl_regions_list', $arr);
		$this->document->addValue('json_tbl_regions_list', json_encode($arr));
	}

}

Kernel::ProcessPage(new IndexPage("regions_catalog.edit.tpl"));