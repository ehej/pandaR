<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.ToursTable");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.TourTypesTable");
Kernel::Import("classes.data.FoodTypesTable");
Kernel::Import("classes.data.PlaceTypesTable");

class IndexPage extends PublicPage {

	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	var $AdvCountriesTable;
	var $data;
	var $toursearch = false;
	var $sale = false;

	var $sfilter = array();
	
	function index() {
		parent::index();
		$this->toursTable 		= new ToursTable($this->connection);
		$this->tourtypesTable 	= new TourTypesTable($this->connection);
		$this->countriesTable 	= new CountriesTable($this->connection);
		$this->FoodTypesTable = new FoodTypesTable($this->connection);
		$this->PlaceTypesTable = new PlaceTypesTable($this->connection);
		$this->ToursTransportTable = new ToursTransportTable($this->connection);
		$this->HotelsTable = new HotelsTable($this->connection);

		$this->intTourID = $this->request->getNumber('intTourID');
		$tmpurl = explode('/',trim($_SERVER['REQUEST_URI'],'/'));

		if($tmpurl[0] == 'tours-country') {
			if($tmpurl[1]=='tourtype') {
				$this->tourtype =  $this->tourtypesTable->Get(array('intTypeID' => $tmpurl[2]));
				$this->sfilter['intTypeID'] = $this->tourtype['intTypeID'];
			} elseif($tmpurl[1]=='sale') {
				$this->sfilter['isSpecial'] = 1;
				$this->sale = true;
			} else {
				$varUrlAlias = $this->request->getString('varUrlAlias');
				$varUrlAlias = current(explode('?', $varUrlAlias));
				$this->country['intCountryID'] = LinkCreator::url_to_id('countries',$varUrlAlias,$this->all_alias);
				$this->country =  $this->countriesTable->GetByFields($this->country);
				$this->sfilter['intCountryID'] = $this->country['intCountryID'];
			}
		}
		
		$this->data = current($this->toursTable->GetList(array('intTourID'=>$this->intTourID), null, null, 'GetListWithNamesPublic', null, true, 1, 1));

		$this->setFilters();
	}
	
	function OnTourSearch() {
		$this->toursearch = true;
	}

	function setFilters() {
		if ( ($name = $this->request->getnumber('intCountryID')) && !empty($name)) $this->sfilter['intCountryID'] = $name;
		if ( ($name = $this->request->getNumber('intResortID')) && !empty($name)) $this->sfilter['intResortID'] = $name;
		if ( ($name = $this->request->getNumber('intTypeID')) && !empty($name)) $this->sfilter['intTypeID'] = $name;
		if ( ($name = $this->request->getNumber('intCountDays')) && !empty($name)) $this->sfilter['intCountDays'] = $name;
		if ( ($name = $this->request->getNumber('intCountPeoples')) && !empty($name)) $this->sfilter['intCountPeoples'] = $name;
		if ( ($name = $this->request->getString('varTransport')) && !empty($name)) $this->sfilter['varTransport'] = $name;
		if ( ($name = $this->request->getString('varResortName')) && !empty($name)) $this->sfilter['varResortName'] = $name;
		if ( ($name = $this->request->getString('varDate')) && !empty($name)) {
			$this->sfilter['FROMvarDateFrom'] = date('Y-m-d', strtotime($name));
			// $this->sfilter['TOvarDateTo'] = date('Y-m-d', strtotime($name));
		}

		$this->sfilter['isVisible'] = 1;
	}
	function OnPrint() {
		$this->response->maintemplate = 'void.tpl';
		$this->document->addValue('print', true);
	}
	
	
	function render() {
		$this->curCountryID = $this->sfilter['intCountryID'];
		parent::render();

		if(!$this->data) {
			$tmpctours = $this->toursTable->GetList($this->sfilter, array('varTypeName' => 'ASC'), null, 'GetListWithNamesPublic');
			
			foreach($tmpctours as $tour) {
				if($tour['varTypeName']) {
					$tour['varFoodTypeName'] = implode(',',$this->FoodTypesTable->getByTour($tour['intTourID']));
					$tour['varPlaceTypeName'] = implode(',',$this->PlaceTypesTable->getByTour($tour['intTourID']));
					$tour['varHotelName'] = implode(',',$this->hotelsTable->getByTour($tour['intTourID']));
					$tour['varResortName'] = implode(',',$this->ResortsTable->getByTour($tour['intTourID']));
					$tour['varTransport'] = implode(',',$this->ToursTransportTable->getByTour($tour['intTourID']));
					$ctours[$tour['varTypeName']][] = $tour;
				}
			}
		}
		$this->addDataCountries('country');
		$this->document->addValue('ModuleMenu', 'tours-country');

		if ( $this->data['intHotelID'] )
		{
			$hotel = $this->HotelsTable->Get(array('intHotelID' => $this->data['intHotelID']));
			$this->data['hotel'] = $hotel;
		}
		
		$this->document->addValue('sfilter', $this->sfilter);
		$this->document->addValue('ctours', $ctours);
		$this->document->addValue('data', $this->data);
		$this->document->addValue('tourUri', $this->country['varUrlAlias']);
		
		$this->breadCrumbs[] = array(
				'title'=>'Главная',
				'url'=>'/',
				'thisPage'=>false
			);
			
		if(!$this->toursearch) {
			if($this->country) {
				$this->breadCrumbs[] = 	array(
					'title'=>$this->country['varName'],
					'url'=>LinkCreator::create(array('varIdentifier'=>$this->country['intCountryID'], 'varModule'=>'country'), $this->all_alias),
					'thisPage'=>false
				);
			}
			
			if($this->intTourID) {
				$this->breadCrumbs[] = 	array(
					'title'=>'Туры'.(($this->country['varName'])?' ('.$this->country['varName'].')':''),
					'url'=>'/tours-country/'.$this->country['varUrlAlias'].'/',
					'thisPage'=>false
				);
				$this->breadCrumbs[] = array(
					'title'=>$this->data['varName'],
					'url'=>'',
					'thisPage'=>true
				);
			} else {
				$this->breadCrumbs[] = 	array(
					'title'=>'Туры '.(($this->country['varName'])?' ('.$this->country['varName'].')':''),
					'url'=>'/tours-country/',
					'thisPage'=>($this->tourtype || $this->sale)?false:true
				);
				
				if($this->tourtype) {
					$this->breadCrumbs[] = 	array(
						'title'=>$this->tourtype['varName'],
						'url'=>'/tours-country/tourtype/'.$this->tourtype['intTypeID'],
						'thisPage'=>true
					);
				} elseif($this->sale) {
					$this->breadCrumbs[] = array(
						'title'=>'Специальные предложения',
						'url'=>'',
						'thisPage'=>true
					);
				}
			}
		} else {
			$this->breadCrumbs[] = array(
				'title'=>'Поиск туров',
				'url'=>'',
				'thisPage'=>true
			);
		}
		
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);
	}
}

Kernel::ProcessPage(new IndexPage("tours.tpl"));