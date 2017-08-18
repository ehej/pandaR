<?php

include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.SpecialOffersTable");
Kernel::Import("classes.data.TblToursTable");
Kernel::Import("classes.data.TblSpoDataTable");
Kernel::Import("classes.data.DepartureCitiesTable");
Kernel::Import("classes.data.PromotionsTypesTable");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.DepartureCitiesTable");
Kernel::Import("classes.data.TblDepartureCitiesTable");

class IndexPage extends AdminPage {

	/**
	 * @var SpecialOffersTable
	 */
	var $specialOffersTable;
	/**
	 * @var TblToursTable
	 */
	var $tblToursTable;
	/**
	 * @var DepartureCitiesTable
	 */
	var $departureCitiesTable;
	/**
	 * @var PromotionsTypesTable
	 */
	var $promotionsTypesTable;
	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	/**
	 * @var RegionsTable
	 */
	var $regionsTable;
	/**
	 * @var TblSpoDataTable
	 */
	var $tblSpoDataTable;
	/**
	 * @var TblDepartureCitiesTable
	 */
	var $tblDepartureCitiesTable;

	var $data = false;

	function index() {
		parent::index();
		$this->setPageTitle('Спецпредложения');
		$this->setBoldMenu('special_offers');

		$this->specialOffersTable = new SpecialOffersTable($this->connection);
		$this->tblToursTable = new TblToursTable($this->mssql_connection);
		$this->tblSpoDataTable = new TblSpoDataTable($this->mssql_connection);
		$this->departureCitiesTable = new DepartureCitiesTable($this->connection);
		$this->promotionsTypesTable = new PromotionsTypesTable($this->connection);
		$this->countriesTable = new CountriesTable($this->connection);
		$this->regionsTable = new RegionsTable($this->connection);
		$this->tblDepartureCitiesTable = new TblDepartureCitiesTable($this->mssql_connection);

		$intSpecOffID = $this->request->getNumber('intSpecOffID', 0);
		if ($intSpecOffID) {
			$this->data = $this->specialOffersTable->Get(array('intSpecOffID' => $intSpecOffID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет спецпредложения с заданным ID');
				$this->response->redirect('index.php');
			}
		}
	}

	function OnCopy() {
		if (!empty($this->data)) {
			unset($this->data['intSpecOffID']);
			unset($this->data['varFile']);
			unset($this->data['varRealFileName']);
			unset($this->data['varFileXML']);
			unset($this->data['varRealFileXMLName']); 	 	 	 	
			$intSpecOffID = $this->specialOffersTable->Insert($this->data);
			if (!empty($intSpecOffID)) $this->response->redirect('special_offers.edit.php?intSpecOffID='.$intSpecOffID);
		}
	}
	
	function OnSave() {		
		$data['intSpecOffID'] = $this->request->getNumber('intSpecOffID');
		$data['varName'] = $this->request->getString('varName', 'NotEmpty');
		$data['intSpecOffIDMT'] = $this->request->getNumber('intSpecOffIDMT');		
		$data['intCountryID'] = $this->request->getNumber('intCountryID');
		$data['intRegionID'] = $this->request->getNumber('intRegionID');
		$data['intDepadtureCityID'] = $this->request->getNumber('intDepadtureCityID');
		if(empty($data['intSpecOffID'])) $data['varDateCreated'] = time();
		$data['varDateFrom'] = $this->request->getDate('varDateFrom');
		$data['varDateTo'] = $this->request->getDate('varDateTo');
		$data['varDateValid'] = $this->request->getDate('varDateValid');
		$data['varDescription'] = $this->request->getString('varDescription');
		$data['varDuration'] = $this->request->getString('varDuration');
		$data['intPromotionTypeID'] = $this->request->getNumber('intPromotionTypeID');
		$data['isShow'] = $this->request->getNumber('isShow');
		$data['varMinPrice'] = $this->request->getString('varMinPrice');
		$data['varFile'] = $this->request->getFiles('varFile');	
		$data['varFileXML'] = $this->request->getFiles('varFileXML');
		$data['varInfo'] = $this->request->getString('varInfo');
		$data['varLink'] = '';
		$data['varInfoByLink'] = $this->request->getString('varInfoByLink');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			
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
			
			if ($data['varFileXML']['size']) {
				$data['varRealFileXMLName'] = $data['varFileXML']['name'];
				$file_path = FILES_PATH;
				if (!empty($this->data['varFileXML'])) unlink($file_path.$this->data['varFileXML']);
				$file_pathinfo = pathinfo($data['varFileXML']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varFileXML']['tmp_name'], $file_path.$file_name);
				chmod($file_path.$file_name, 0777);
				$data['varFileXML'] = $file_name;
			} else $data['varFileXML'] = $this->data['varFileXML'];
			
			if (isset($data['intSpecOffID']) && !empty($data['intSpecOffID'])) {
				$this->specialOffersTable->Update($data);
				$SPO = $this->specialOffersTable->Get(array('intSpecOffID' => $data['intSpecOffID']));
				$intSpecOffID = $SPO['intSpecOffID'];
			} else {
				$intSpecOffID = $this->specialOffersTable->Insert($data);
			}

			$link = 'country='.$data['intCountryID'].'&tour='.$intSpecOffID.'&varDateFrom='.$data['varDateFrom'].'&varDateTo='.$data['varDateTo']; 
			$arr = array('intSpecOffID' => $intSpecOffID, 'varLink' => $link);
			$this->specialOffersTable->Update($arr);
			
			$this->addMessage('Данные успешно сохранены');
			$this->response->redirect('special_offers.php');
			//if (isset($data['intSpecOffID']) && !empty($data['intSpecOffID'])) $this->response->redirect('special_offers.edit.php?intSpecOffID='.$data['intSpecOffID']);
		}
	}

	function OnDeleteFile() {
		$data['intSpecOffID'] = $this->request->getNumber('intSpecOffID', 'NotEmpty');
		$data['varFile'] =	$this->request->getString('varFile', 'NotEmpty');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки');
		} else {
			if (!empty($this->data['varFile'])) {
				unlink(FILES_PATH.$this->data['varFile']);
				$this->data['varFile'] = '';
				$this->data['varRealFileName'] = '';
				$this->specialOffersTable->Update($this->data);
			}
		}
	}
	
	function OnDeleteFileXML() {
		$data['intSpecOffID'] = $this->request->getNumber('intSpecOffID', 'NotEmpty');
		$data['varFileXML'] =	$this->request->getString('varFileXML', 'NotEmpty');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки');
		} else {
			if (!empty($this->data['varFileXML'])) {
				unlink(FILES_PATH.$this->data['varFileXML']);
				$this->data['varFileXML'] = '';
				$this->data['varRealFileXMLName'] = '';
				$this->specialOffersTable->Update($this->data);
			}
		}
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('FILES_URL', FILES_URL);
		$departure_cities_list = $this->departureCitiesTable->GetList();
		$this->document->addValue('departure_cities_list', $departure_cities_list);
		$this->document->addValue('json_departure_cities_list', json_encode($departure_cities_list));
		$this->document->addValue('promotions_types_list', $this->promotionsTypesTable->GetList());
		$countries_list = $this->countriesTable->getListIDsNames();
		$this->document->addValue('countries_list', $countries_list);
		$this->document->addValue('json_countries_list', json_encode($countries_list));
		$regions_list = $this->regionsTable->getListIDsNames();

		$this->document->addValue('regions_list', $regions_list);
		$this->document->addValue('json_regions_list', json_encode($regions_list));
		$tbl_tours_list = $this->tblSpoDataTable->GetListDistinct();
		foreach ($tbl_tours_list as $key => $value) {
			$tbl_tours_list[$key]['sd_tourkey'] = iconv('WINDOWS-1251', 'UTF-8', $value['sd_tourkey']);
			$tbl_tours_list[$key]['sd_tourname'] = iconv('WINDOWS-1251', 'UTF-8', $value['sd_tourname']);
		}
		
		$tbl_tours = $this->tblToursTable->GetList();
		foreach ($tbl_tours as $key => $value) {
			$tbl_tours[$key]['TO_Key'] = iconv('WINDOWS-1251', 'UTF-8', $value['TO_Key']);
			$tbl_tours[$key]['TO_Name'] = iconv('WINDOWS-1251', 'UTF-8', $value['TO_Name']);
			$tbl_tours[$key]['TO_DateBegin'] = strtotime($tbl_tours[$key]['TO_DateBegin']);
			$tbl_tours[$key]['TO_DateEnd'] = strtotime($tbl_tours[$key]['TO_DateEnd']);
			$tbl_tours[$key]['TO_DateValid'] = strtotime($tbl_tours[$key]['TO_DateValid']);
			$tbl_tours[$key]['TO_HotelNights'] = trim($tbl_tours[$key]['TO_HotelNights']);
		}
		
		
		foreach ($tbl_tours_list as $key => $value) {
			foreach ($tbl_tours as $k => $val) {
				if ($value['sd_tourkey'] == $val['TO_Key']) { 
					$tbl_tours_list[$key]['TO_DateBegin'] = $val['TO_DateBegin'];
					$tbl_tours_list[$key]['TO_DateEnd'] = $val['TO_DateEnd'];
					$tbl_tours_list[$key]['TO_DateValid'] = $val['TO_DateValid'];
					$tbl_tours_list[$key]['TO_HotelNights'] = trim($val['TO_HotelNights']);
					$tbl_tours_list[$key]['sd_ctkeyfrom'] = $value['sd_ctkeyfrom'];		
				}
			}
		}
		$this->document->addValue('tbl_tours_list', $tbl_tours_list);
		$this->document->addValue('json_tbl_tours_list', json_encode($tbl_tours_list));
		


		
		$dep_cities_list = $this->departureCitiesTable->GetList();
		
		$this->document->addValue('dep_cities_list', $dep_cities_list);
		$this->document->addValue('t', json_encode($dep_cities_list));
		
		$tmp = $this->tblDepartureCitiesTable->GetList();
		$arr = array();
		foreach ($tmp as $key => $value) {
			$arr[$key]['ap_key'] = iconv('WINDOWS-1251', 'UTF-8', $value['ap_key']);
			$arr[$key]['AP_CTKEY'] = iconv('WINDOWS-1251', 'UTF-8', $value['AP_CTKEY']); // id региона
			$arr[$key]['AP_NAME'] = iconv('WINDOWS-1251', 'UTF-8', $value['AP_NAME']);
		}
		$this->document->addValue('tbl_dep_cities_list', $arr);
		$this->document->addValue('json_tbl_dep_cities_list', json_encode($arr));
		
		
		$this->document->addValue('data', $this->data);
	}

}

Kernel::ProcessPage(new IndexPage("special_offers.edit.tpl"));