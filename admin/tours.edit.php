<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.ToursTable");
Kernel::Import("classes.data.TourTypesTable");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.HotelsTable");
Kernel::Import("classes.data.CurrenciesTable");
Kernel::Import("classes.data.PlaceTypesTable");
Kernel::Import("classes.data.FoodTypesTable");

class IndexPage extends AdminPage {

	var $toursTable, $typesTable, $countriesTable, $regionsTable;
	var $data = false;

	function index() {
		parent::index();
		$this->setPageTitle('Редактирование данных тура');
		$this->setBoldMenu('tours');
		$this->toursTable = new toursTable($this->connection);
		$this->tourtypesTable = new TourTypesTable($this->connection);
		$this->countriesTable = new CountriesTable($this->connection);
		$this->regionsTable = new RegionsTable($this->connection);
		$this->resortsTable = new ResortsTable($this->connection);
		$this->hotelsTable = new HotelsTable($this->connection);
		$this->currenciesTable = new CurrenciesTable($this->connection);
		$this->ToursCountriesTable = new ToursCountriesTable($this->connection);
		$this->ToursHotelsTable = new ToursHotelsTable($this->connection);
		$this->ToursTypesTable = new ToursTypesTable($this->connection);
		$this->ToursTransportTable = new ToursTransportTable($this->connection);
		$this->ToursResortsTable = new ToursResortsTable($this->connection);
		$this->ToursFoodTable = new ToursFoodTable($this->connection);
		$this->ToursPlacementTable = new ToursPlacementTable($this->connection);
		$this->ToursCountPeoplesTable = new ToursCountPeoplesTable($this->connection);
		$this->FoodTypesTable = new FoodTypesTable($this->connection);
		$this->PlaceTypesTable = new PlaceTypesTable($this->connection);
		
		$intTourID = $this->request->getNumber('intTourID', 0);
		if ($intTourID) {
			$this->data = $this->toursTable->Get(array('intTourID'=>$intTourID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет тура с заданным ID');
				$this->response->redirect('tours.php');
			}
		}
	}

	function OnDeleteFile() {
		$data['intTourID'] = $this->request->getNumber('intTourID', 'NotEmpty');
		$data['varFile'] =	$this->request->getString('varFile', 'NotEmpty');	
		$data['intFilePos'] = $this->request->getNumber('intFilePos', 'NotEmpty');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки');
		} else {
			if (!empty($this->data['varFile'.$data['intFilePos']])) {
				unlink(FILES_PATH.$this->data['varFile'.$data['intFilePos']]);
				$this->data['varFile'.$data['intFilePos']] = '';
				$this->data['varRealFile'.$data['intFilePos'].'Name'] = '';
				$this->toursTable->update($this->data);
			}
		}
	}
	
 	function OnSave() {
 		if(isset($this->data['intTourID']) && is_numeric($this->data['intTourID'])){
			$data = $this->toursTable->get(array('intTourID'=>$this->data['intTourID']));
		}
		$data['varName'] =	$this->request->getString('varName', 'NotEmpty');
		$data['varShortDescription'] = $this->request->getString('varShortDescription');
		$data['varDescription'] = $this->request->getString('varDescription');
		$data['varDescriptionBottom'] = $this->request->getString('varDescriptionBottom');
		$data['varDateFrom'] = date('Y-m-d', $this->request->getDate('varDateFrom'));
		$data['varDateTo'] = date('Y-m-d', $this->request->getDate('varDateTo'));
		if ($data['varDateFrom'] > $data['varDateTo']){
			$t = $data['varDateTo'];
			$data['varDateTo'] = $data['varDateFrom'];
			$data['varDateFrom'] = $t;
		}
		$data['varF'] = $this->request->getString('varF');
		$data['varComment'] = $this->request->getString('varComment');
		$data['intPriceFrom'] = $this->request->getNumber('intPriceFrom');
		$data['intPriceTo'] = $this->request->getNumber('intPriceTo');
		$data['intRegionID'] = $this->request->getNumber('intRegionID');
		$country = $this->regionsTable->get(array('intRegionID'=>$data['intRegionID']));
		$data['intCountDays'] = $this->request->getNumber('intCountDays');
		$data['intCurrencyID'] = $this->request->getNumber('intCurrencyID');
		$data['intHotelID'] = $this->request->getNumber('intHotelID');
		
		$data['varStatement'] = $this->request->getString('varStatement');
		$data['varHeat'] = $this->request->getString('varHeat');
		
		$data['isSpecial'] = $this->request->getNumber('isSpecial', 0);
		$data['isVisible'] = $this->request->getNumber('isVisible', 0);
		$data['isIndex'] = $this->request->getNumber('isIndex', 0);
		$data['varDays'] = $this->request->getString('varDays');
		$data['varFile1'] = $this->request->getFiles('varFile1');
		$data['varFile2'] = $this->request->getFiles('varFile2');
		$data['varFile3'] = $this->request->getFiles('varFile3');

		$intCountPeoples= $this->request->Value('intCountPeoples');
		$intTypeID 		= $this->request->Value('intTypeID');
		$intCountryID 	= $this->request->Value('intCountryID');
		$intResortID 	= $this->request->Value('intResortID');
		$varTransport 	= $this->request->Value('varTransport');
		$intFoodTypeID 	= $this->request->Value('intFoodTypeID');
		$intPlaceTypeID = $this->request->Value('intPlaceTypeID');

		$data['varAgencyComission'] = $this->request->getString('varAgencyComission');
		$data['varAgencyDescription'] = $this->request->getString('varAgencyDescription');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {

			if ($data['varFile1']['size']) {
				$data['varRealFile1Name'] = $data['varFile1']['name'];
				$file_path = FILES_PATH;
				if (!empty($this->data['varFile1'])) unlink($file_path.$this->data['varFile1']);
				$file_pathinfo = pathinfo($data['varFile1']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varFile1']['tmp_name'], $file_path.$file_name);
				chmod($file_path.$file_name, 0777);
				$data['varFile1'] = $file_name;
			} else $data['varFile1'] = $this->data['varFile1'];
			
			if ($data['varFile2']['size']) {
				$data['varRealFile2Name'] = $data['varFile2']['name'];
				$file_path = FILES_PATH;
				if (!empty($this->data['varFile2'])) unlink($file_path.$this->data['varFile2']);
				$file_pathinfo = pathinfo($data['varFile2']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varFile2']['tmp_name'], $file_path.$file_name);
				chmod($file_path.$file_name, 0777);
				$data['varFile2'] = $file_name;				
			} else $data['varFile2'] = $this->data['varFile2'];
			
			if ($data['varFile3']['size']) {
				$data['varRealFile3Name'] = $data['varFile3']['name'];
				$file_path = FILES_PATH;
				if (!empty($this->data['varFile3'])) unlink($file_path.$this->data['varFile3']);
				$file_pathinfo = pathinfo($data['varFile3']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varFile3']['tmp_name'], $file_path.$file_name);
				chmod($file_path.$file_name, 0777);
				$data['varFile3'] = $file_name;			
			} else $data['varFile3'] = $this->data['varFile3'];
			
			if (isset($data['intTourID']) && !empty($data['intTourID'])) {
				$del = array('intTourID'=>$data['intTourID']);
				$this->ToursCountriesTable->DeleteByFields($del);
				$del = array('intTourID'=>$data['intTourID']);
				$this->ToursResortsTable->DeleteByFields($del);
				$del = array('intTourID'=>$data['intTourID']);
				$this->ToursHotelsTable->DeleteByFields($del);
				$del = array('intTourID'=>$data['intTourID']);
				$this->ToursTypesTable->DeleteByFields($del);
				$del = array('intTourID'=>$data['intTourID']);
				$this->ToursTransportTable->DeleteByFields($del);
				$del = array('intTourID'=>$data['intTourID']);
				$this->ToursFoodTable->DeleteByFields($del);
				$del = array('intTourID'=>$data['intTourID']);
				$this->ToursCountPeoplesTable->DeleteByFields($del);
				$del = array('intTourID'=>$data['intTourID']);
				$this->ToursPlacementTable->DeleteByFields($del);
				$this->toursTable->Update($data);
			} else {
				$this->toursTable->Insert($data);
			}
			$ID = $data['intTourID'];
			foreach((array)$intTypeID as $row) {
				$item = array(
					'intTypeID'=>$row,
					'intTourID'=>$ID
				);
				$this->ToursTypesTable->insert($item,true);
			}
			foreach((array)$intCountryID as $row) {
				$item = array(
					'intCountryID'=>$row,
					'intTourID'=>$ID
				);
				$this->ToursCountriesTable->insert($item,true);
			}
			foreach((array)$intResortID as $row) {
				$item = array(
					'intResortID'=>$row,
					'intTourID'=>$ID
				);
				$this->ToursResortsTable->insert($item,true);
			}
			foreach((array)$varTransport as $row) {
				$item = array(
					'varTransport'=>$row,
					'intTourID'=>$ID
				);
				$this->ToursTransportTable->insert($item,true);
			}
			foreach((array)$intFoodTypeID as $row) {
				$item = array(
					'intFoodTypeID'=>$row,
					'intTourID'=>$ID
				);
				$this->ToursFoodTable->insert($item,true);
			}
			foreach((array)$intCountPeoples as $row) {
				$item = array(
					'intCountPeoples'=>$row,
					'intTourID'=>$ID,
				);
				$this->ToursCountPeoplesTable->insert($item,true);
			}
			foreach((array)$intPlaceTypeID as $row) {
				$item = array(
					'intPlaceTypeID'=>$row,
					'intTourID'=>$ID
				);
				$this->ToursPlacementTable->insert($item,true);
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intTourID']) && !empty($data['intTourID'])) $this->response->redirect('tours.edit.php?intTourID='.$data['intTourID']);
		}
		$this->response->redirect('tours.edit.php?intTourID='.$data['intTourID']);
	}

	function render() {
		parent::render();
		$this->data['varDateFrom'] = strtotime($this->data['varDateFrom']);
		$this->data['varDateTo'] = strtotime($this->data['varDateTo']);
		$intTypeID = $this->ToursTypesTable->getList(array('intTourID'=>$this->data['intTourID']));
		$this->data['intTypeID'] = 
		$this->data['intCountryID'] = 
		$this->data['intResortID'] = 
		$this->data['varTransport'] = 
		$this->data['intFoodTypeID'] = 
		$this->data['intPlaceTypeID'] = 
		array();
		foreach($intTypeID as $row) {
			$this->data['intTypeID'][] = $row['intTypeID'];
		}
		$intCountryID = $this->ToursCountriesTable->getList(array('intTourID'=>$this->data['intTourID']));
		foreach($intCountryID as $row) {
			$this->data['intCountryID'][] = $row['intCountryID'];
		}
		$intResortID = $this->ToursResortsTable->getList(array('intTourID'=>$this->data['intTourID']));
		foreach($intResortID as $row) {
			$this->data['intResortID'][] = $row['intResortID'];
		}
		$varTransport = $this->ToursTransportTable->getList(array('intTourID'=>$this->data['intTourID']));
		foreach($varTransport as $row) {
			$this->data['varTransport'][] = $row['varTransport'];
		}
		$intFoodTypeID = $this->ToursFoodTable->getList(array('intTourID'=>$this->data['intTourID']));
		foreach($intFoodTypeID as $row) {
			$this->data['intFoodTypeID'][] = $row['intFoodTypeID'];
		}
		$intPlaceTypeID = $this->ToursPlacementTable->getList(array('intTourID'=>$this->data['intTourID']));
		foreach($intPlaceTypeID as $row) {
			$this->data['intPlaceTypeID'][] = $row['intPlaceTypeID'];
		}
		$intCountPeoples = $this->ToursCountPeoplesTable->getList(array('intTourID'=>$this->data['intTourID']));
		foreach($intCountPeoples as $row) {
			$this->data['intCountPeoplesID'][] = $row['intCountPeoples'];
		}
		
		$this->document->addValue('data', $this->data);
		$this->document->addValue('range325', range(1, 25));
		$this->document->addValue('range15', range(3, 5));
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('types_list', $this->tourtypesTable->getList(array('intActive'=>1), array('varName'=>'asc')));
		$this->document->addValue('currencies', $this->currenciesTable->getList());
		$this->document->addValue('hotels_list', $this->hotelsTable->getList());
		$this->document->addValue('resorts_list', $this->resortsTable->getList());
		$this->document->addValue('transport_list', ToursTable::GetTransport());
		$this->document->addValue('placement_list', $this->PlaceTypesTable->getList());
		$this->document->addValue('food_list', $this->FoodTypesTable->getList());
		
		$this->document->addValue('countries_list', $this->countriesTable->getList(null, array('varName'=>'asc')));
		$this->document->addValue('regions_list', $this->regionsTable->getList(null, array('varName'=>'asc'), null, 'GetListWithCountryName', 'getSQLRows'));
		if (!empty($this->data['varFile']))	$this->document->addValue('file', FILES_URL.$this->data['varFile']);
	}

}

Kernel::ProcessPage(new IndexPage("tours.edit.tpl"));