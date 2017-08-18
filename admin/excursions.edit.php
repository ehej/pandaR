<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.GallerysTable");
Kernel::Import("classes.data.GalleriesToModulesTable");

Kernel::Import("classes.data.BannersMainTable");
Kernel::Import("classes.data.BannersToModulesTable");

Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.ResortsTable");

Kernel::Import("classes.data.ExcursionsTable");

class IndexPage extends AdminPage {


	/**
	 * @var GallerysTable
	 */
	var $gallerysTable;
	/**
	 * @var GalleriesToModulesTable
	 */
	var $galleriesToModulesTable;
	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	/**
	 * @var RegionsTable
	 */
	var $regionsTable;
	/**
	 * @var ResortsTable
	 */
	var $resortsTable;
	/**
	 * @var BannersToModulesTable
	 */
	var $bannersToModulesTable;
	/**
	 * @var BannersMainTable
	 */
	var $bannersMainTable;
	/**
	 * @var ExcursionsTable
	 */
	var $excursionsTable;
	
	var $excursionsRelationTable;
	
	var $data = false;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных экскурсии');
		$this->setBoldMenu('excursions');		
		
		$this->excursionsTable = new ExcursionsTable($this->connection);
		$this->excursionsRelationTable = new ExcursionsRelationTable($this->connection);
		
		$this->countriesTable = new CountriesTable($this->connection);
		$this->resortsTable = new ResortsTable($this->connection);
		$this->regionsTable = new RegionsTable($this->connection);
		
		$this->gallerysTable = new GallerysTable($this->connection);
		$this->galleriesToModulesTable = new GalleriesToModulesTable($this->connection);
		
		$this->bannersToModulesTable = new BannersToModulesTable($this->connection);
		$this->bannersMainTable = new BannersMainTable($this->connection);
		
		$intExcursionID = $this->request->getNumber('intExcursionID', 0);
		if ($intExcursionID) {
			$this->data = $this->excursionsTable->Get(array('intExcursionID' => $intExcursionID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет экскурсии с заданным ID');
				$this->response->redirect('excursions.php');
			}
		}
	}

 	function OnSave() {
		$data['intExcursionID']			= $this->request->getNumber('intExcursionID');
		$data['varName']				= $this->request->getString('varName', 'NotEmpty');
		$data['varMetaTitle'] 			= $this->request->getString('varMetaTitle');
		$data['varMetaKeywords'] 		= $this->request->getString('varMetaKeywords');
		$data['varMetaDescription'] 	= $this->request->getString('varMetaDescription');
		$data['varDescription'] 		= $this->request->getString('varDescription', 'NotEmpty');
		$data['varShowComments'] 		= $this->request->getString('varShowComments');
		$data['isActive'] 				= $this->request->getNumber('isActive');
		if(!$data['varShowComments']) $data['varShowComments'] = 'no';
		$intGalleryIDList 				= $this->request->Value('intGalleryID');
		$intBannersMainIDList 			= $this->request->Value('intBannerZoneID');
		
		$intCounryIDList 				= $this->request->Value('intCountryID');
		$intResortIDList 				= $this->request->Value('intResortID');
		//$intRegionIDList 				= $this->request->Value('intRegionID');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			

			if (isset($data['intExcursionID']) && !empty($data['intExcursionID'])) {
				$this->excursionsTable->Update($data);
			} else {
				$this->excursionsTable->Insert($data);
			}

			$intExcursionID = $data['intExcursionID'];
			$arrTmp = array('varModuleName' => 'excursions', 'intModuleID' => $intExcursionID);
			$this->galleriesToModulesTable->DeleteByFields($arrTmp);	
			foreach($intGalleryIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'excursions';
				$d['intModuleID'] = $intExcursionID;
				$d['intGalleryID'] = $value;
				$this->galleriesToModulesTable->Insert($d);
			}
			$this->bannersToModulesTable->DeleteByFields($arrTmp);	
			foreach($intBannersMainIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'excursions';
				$d['intModuleID'] = $intExcursionID;
				$d['intBannerZoneID'] = $value;
				$this->bannersToModulesTable->Insert($d);
			}
			
			$arrTmp = array('intExcursionID' => $intExcursionID);	
			$this->excursionsRelationTable->DeleteByFields($arrTmp);	
			
			foreach($intCounryIDList as $key => $value) {
				$d = array();
				$d['intExcursionID'] = $intExcursionID;
				$d['intDestinationID'] = $value;
				$d['varDestinationType'] = 'country';
				$this->excursionsRelationTable->Insert($d);
			}
			foreach($intResortIDList as $key => $value) {
				$d = array();
				$d['intExcursionID'] = $intExcursionID;
				$d['intDestinationID'] = $value;
				$d['varDestinationType'] = 'resort';
				$this->excursionsRelationTable->Insert($d);
			}
			/*foreach($intRegionIDList as $key => $value) {
				$d = array();
				$d['intExcursionID'] = $intExcursionID;
				$d['intDestinationID'] = $value;
				$d['varDestinationType'] = 'region';
				$this->excursionsRelationTable->Insert($d);
			}*/
			
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intExcursionID']) && !empty($data['intExcursionID'])) $this->response->redirect('excursions.edit.php?intExcursionID='.$data['intExcursionID']);
		}
	}
	
	function render() {
		parent::render();
		
		$relation_list = $this->excursionsRelationTable->GetList(array('intExcursionID'=>$this->data['intExcursionID']));
		foreach ($relation_list as $value) {
			$tmp[$value['varDestinationType']][$value['intDestinationID']] = $value;
		}
		$relation_list = $tmp;

		$tmp = array();
		$countries_list = $this->countriesTable->GetList(null, array('varName'=>'ASC'));
		foreach ($countries_list as $value) {
			$tmp[$value['intCountryID']] = $value;
		}
		$country_list = $tmp;
		
		$tmp = array();
		$resort_list = $this->resortsTable->GetList(null, array('varName'=>'ASC'));
		foreach ($resort_list as $value) {
			$tmp[$value['intResortID']] = $value;
		}
		$resort_list = $tmp;

		$tmp = array();
		$region_list = $this->regionsTable->GetList(null, array('varName'=>'ASC'));
		foreach ($region_list as $value) {
			$tmp[$value['intRegionID']] = $value;
		}
		$region_list = $tmp;
		
		$this->document->addValue('data', $this->data);	
		$this->document->addValue('relation_list', $relation_list);
		$this->document->addValue('country_list', $country_list);
		$this->document->addValue('resort_list', $resort_list);
		$this->document->addValue('region_list', $region_list);
		
		
		$this->document->addValue('banners_main_list', $this->bannersMainTable->GetList());

		$this->document->addValue('galeries_list', $this->gallerysTable->GetList());
        if($this->data['intExcursionID']!='') {
            $this->document->addValue('banners_to_modules', $this->bannersToModulesTable->GetList(array('varModuleName' => 'excursions', 'intModuleID' => $this->data['intExcursionID'])));
		    $this->document->addValue('galleries_to_modules', $this->galleriesToModulesTable->GetList(array('varModuleName' => 'excursions', 'intModuleID' => $this->data['intExcursionID'])));
        }
	}

}

Kernel::ProcessPage(new IndexPage("excursions.edit.tpl"));