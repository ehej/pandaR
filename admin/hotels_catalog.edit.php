<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.HotelsTable");
Kernel::Import("classes.data.FoodTypesTable");
Kernel::Import("classes.data.PlaceTypesTable");
Kernel::Import("classes.data.HotelsOptionTable");
Kernel::Import("classes.data.HotelsTypesTable");
Kernel::Import("classes.data.TblHotelTable");
Kernel::Import("classes.data.GallerysTable");
Kernel::Import("classes.data.GalleriesToModulesTable");
Kernel::Import("classes.data.BannersMainTable");
Kernel::Import("classes.data.BannersToModulesTable");
Kernel::Import("classes.data.CurrenciesTable");

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
	 * @var HotelsTable
	 */
	var $hotelsTable;
	/**
	 * @var HotelsTypesTable
	 */
	var $hoteltypesTable;
	/**
	 * @var HotelsOptionTable
	 */
	var $hotelsOptionTable;
	/**
	 * @var TblHotelTable
	 */
	var $tblHotelTable;
	/**
	 * @var BannersToModulesTable
	 */
	var $bannersToModulesTable;
	/**
	 * @var BannersMainTable
	 */
	var $bannersMainTable;
	
	
	
	var $currenciesTable;
	var $stars = array('0'=>'Без звездности','1'=>'1*','2'=>'2*','3'=>'3*','4'=>'4*','5'=>'5*');
	
	
	var $data = false;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных отеля');
		$this->setBoldMenu('hotelsCatalog');		
		
		$this->countriesTable = new CountriesTable($this->connection);
		$this->regionsTable = new RegionsTable($this->connection);
		$this->resortsTable = new ResortsTable($this->connection);
		$this->hotelsTable = new HotelsTable($this->connection);
		$this->foodtypesTable = new FoodTypesTable($this->connection);
		$this->placetypesTable = new PlaceTypesTable($this->connection);
		$this->hotelsOptionTable = new HotelsOptionTable($this->connection);
		$this->gallerysTable = new GallerysTable($this->connection);
		$this->galleriesToModulesTable = new GalleriesToModulesTable($this->connection);
		$this->tblHotelTable = new TblHotelTable($this->mssql_connection);
		$this->bannersToModulesTable = new BannersToModulesTable($this->connection);
		$this->bannersMainTable = new BannersMainTable($this->connection);
		$this->hoteltypesTable = new HotelsTypesTable($this->connection);
		$this->currenciesTable = new CurrenciesTable($this->connection);
		
		$intHotelID = $this->request->getNumber('intHotelID', 0);
		if ($intHotelID) {
			$this->data = $this->hotelsTable->Get(array('intHotelID' => $intHotelID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет отеля с заданным ID');
				$this->response->redirect('hotels_catalog.php');
			}
		}
	}

 	function OnSave() {
 		$data['intHotelID'] = $this->request->getNumber('intHotelID');	
 		$data['varUrlAlias'] = $this->request->getString('varUrlAlias', 'NotEmpty');
		$data['intRegionID'] = $this->request->getNumber('intRegionID');	
		$data['intResortID'] = $this->request->getNumber('intResortID', 'NotEmpty');	
		$data['intCountryID'] = $this->request->getNumber('intCountryID', 'NotEmpty');	
		$data['varName'] =	$this->request->getString('varName', 'NotEmpty');
		$data['varMetaTitle'] = $this->request->getString('varMetaTitle');
		$data['varMetaKeywords'] = $this->request->getString('varMetaKeywords');
		$data['varMetaDescription'] = $this->request->getString('varMetaDescription');
		$data['varDescription'] = $this->request->getString('varDescription', 'NotEmpty');
		$data['varShowComments'] = $this->request->getString('varShowComments');
		$data['varPriceAt'] = $this->request->getString('varPriceAt');
		if(!$data['varShowComments']) $data['varShowComments'] = 'no';
		$intGalleryIDList = $this->request->Value('intGalleryID');
		$intBannersMainIDList = $this->request->Value('intBannerZoneID');
		$data['intMTHotels'] = $this->request->getNumber('intMTHotels');
		$data['isCommented'] = $this->request->getNumber('isCommented');
		$data['isActive'] = $this->request->getNumber('isActive');
		$data['intCurrencyID'] = $this->request->getNumber('intCurrencyID');
		
		$data['varCountStars'] = $this->request->getString('varCountStars');
		$data['intFoodBB'] = $this->request->getNumber('intFoodBB');
		$data['intFoodHB'] = $this->request->getNumber('intFoodHB');
		$data['intFoodFB'] = $this->request->getNumber('intFoodFB');
		$data['intFoodAI'] = $this->request->getNumber('intFoodAI');
		$data['intFoodOB'] = $this->request->getNumber('intFoodOB');
		$data['intVIP'] = $this->request->getNumber('intVIP');
		$data['intFoodTypeID'] = $this->request->getNumber('intFoodTypeID');
		$data['intPlaceTypeID'] = $this->request->getNumber('intPlaceTypeID');
		$data['intHotelTypeID'] = $this->request->getNumber('intHotelTypeID');

		$intOptionID = $this->request->Value('intOptionID');
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			
			if (isset($data['intHotelID']) && !empty($data['intHotelID'])) {
				$this->hotelsTable->Update($data);
			} else {
				$this->hotelsTable->Insert($data);
			}
			
			$intHotelID = $data['intHotelID'];
			$arrTmp = array('varModuleName' => 'hotels', 'intModuleID' => $intHotelID);
			$this->galleriesToModulesTable->DeleteByFields($arrTmp);	
			foreach($intGalleryIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'hotels';
				$d['intModuleID'] = $data['intHotelID'];
				$d['intGalleryID'] = $value;
				$this->galleriesToModulesTable->Insert($d);
			}
			
			$intHotelID = $data['intHotelID'];
			$arrTmp = array('varModuleName' => 'hotels', 'intModuleID' => $intHotelID);
			$this->bannersToModulesTable->DeleteByFields($arrTmp);	
			foreach($intBannersMainIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'hotels';
				$d['intModuleID'] = $data['intHotelID'];
				$d['intBannerZoneID'] = $value;
				$this->bannersToModulesTable->Insert($d);
			}
			
			$intHotelID = $data['intHotelID'];
			$this->hotelsOptionTable->deleteOptionRelation($intHotelID);	
			foreach($intOptionID as $key => $value) {
				$this->hotelsOptionTable->insertOptionRelation($intHotelID, $data['intResortID'], $value);	
			}
			
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intHotelID']) && !empty($data['intHotelID'])) $this->response->redirect('hotels_catalog.edit.php?intHotelID='.$data['intHotelID']);
		}
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('data', $this->data);		
		
		$tmp = $this->countriesTable->getListIDsNames();
		foreach($tmp as $v){
			$countries[$v['intCountryID']] = $v;
		}
		$this->document->addValue('countries_list', $countries);
		
		//$this->document->addValue('json_countries_list', json_encode($countries));
		
		$tmp = $this->regionsTable->GetList(null, array('varName'=>'asc'));
		foreach($tmp as $v){
			$regions[$v['intRegionID']] = $v;
		}
		$this->document->addValue('regions_list', $regions);
		
		$tmp = $this->resortsTable->GetList(null, array('varName'=>'asc'));
		foreach($tmp as $v){
			$resorts[$v['intResortID']] = $v;
		}
		$this->document->addValue('resorts_list', $resorts);
		$tmp = array();
		$option = $this->hotelsOptionTable->GetList(null, array('intOrdering'=>'ASC'));
		foreach ($option as $key => $value) {
			$tmp[$value['intOptionID']] = $value;
		}
		$option = $tmp;
		//print_r($option);
		$this->document->addValue('option', $option );
		$option_relation = $this->hotelsOptionTable->getOptionRelation($this->data['intHotelID']);
		foreach ($option_relation as $key => $value) {
			$tmp[] = $value['intOptionID'];
		}
		$option_relation = $tmp;
		//print_r($option_relation);
		$this->document->addValue('option_relation', $option_relation);
		$this->document->addValue('stars', $this->stars);
		$this->document->addValue('foodtypes', $this->foodtypesTable->GetList());
		$this->document->addValue('placetypes', $this->placetypesTable->GetList());
		$this->document->addValue('hoteltypes', $this->hoteltypesTable->GetList());
		$this->document->addValue('currencies', $this->currenciesTable->getList());

		$this->document->addValue('banners_main_list', $this->bannersMainTable->GetList());

		$this->document->addValue('galeries_list', $this->gallerysTable->GetList(null, array('varTitle'=>'ASC')));
        if($this->data['intHotelID']!='') {
            $this->document->addValue('banners_to_modules', $this->bannersToModulesTable->GetList(array('varModuleName' => 'hotels', 'intModuleID' => $this->data['intHotelID'])));
		    $this->document->addValue('galleries_to_modules', $this->galleriesToModulesTable->GetList(array('varModule' => 'hotels', 'intModuleID' => $this->data['intHotelID'])));
        }
	}

}

Kernel::ProcessPage(new IndexPage("hotels_catalog.edit.tpl"));