<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.HotelsTable");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.StaffsTable");
Kernel::Import("classes.data.StaffsContactTable");
Kernel::Import("classes.data.StaffsRelationCoutrysTable");
Kernel::Import("classes.data.HotelsOptionTable");
Kernel::Import("classes.data.CatalogMenuTable");
Kernel::Import("classes.data.HotelsTypesTable");
Kernel::Import("classes.data.CurrenciesTable");


class IndexPage extends PublicPage {

	var $hotelsTable;
	var $regionsTable;
	var $resortsTable;
	var $countriesTable;
	var $StaffsTable;
	var $StaffsContactTable;
	var $StaffsRelationCoutrysTable;
	var $hotelsOptionTable;
	var $CatalogMenuTable;
	var $HotelsTypesTable;
	var $CurrenciesTable;
	var $data = false;
	var $country;
	var $page;
	var $stars = array('1'=>'1*','2'=>'2*','3'=>'3*','4'=>'4*','5'=>'5*','a'=>'Apts','v'=>'Villa');
	
	function index() {
		parent::index();

		$this->hotelsTable 					= new HotelsTable($this->connection);
		$this->regionsTable 				= new RegionsTable($this->connection);
		$this->resortsTable 				= new ResortsTable($this->connection);
		$this->countriesTable 				= new CountriesTable($this->connection);
		$this->StaffsTable 					= new StaffsTable($this->connection);
		$this->StaffsContactTable 			= new StaffsContactTable($this->connection);
		$this->StaffsRelationCoutrysTable 	= new StaffsRelationCountryTable($this->connection);
		$this->hotelsOptionTable 			= new HotelsOptionTable($this->connection);
		$this->CatalogMenuTable 			= new CatalogMenuTable($this->connection);
		$this->HotelsTypesTable 			= new HotelsTypesTable($this->connection);
		$this->CurrenciesTable 				= new CurrenciesTable($this->connection);

		$intCountryID = $this->request->getNumber('intCountryID', 0);
		
		$varUrlAlias = $this->request->getString('varUrlAlias');
		if(empty($intCountryID)) {
			$intCountryID = LinkCreator::url_to_id('countries',$varUrlAlias,$this->all_alias);
		}
		
		$this->country = $this->countriesTable->Get(array('intCountryID' => $intCountryID));
		if ($intCountryID) {
			if (empty($this->country)) {
				$this->response->redirect('index.php');
			}
		}

		$tmpurl = explode('/',trim($_SERVER['REQUEST_URI'],'/'));
		if($tmpurl[0] == 'hotels-country') {
			$country = $this->countriesTable->GetByFields(array('varUrlAlias'=>$_REQUEST['varUrlAlias']));
			$this->sfilter['intCountryID'] = $country['intCountryID'];
		}
		$this->setPageTitle('Отели | '.$this->country['varName'], $this->country['varMetaKeywords'], $this->country['varMetaDescription']);
	}

	function render() {
		parent::render();
		$this->page = $this->request->getNumber('page');
		$find_option = $this->request->Value('find_option');
		$find_option = array_filter((array)$find_option);
		$this->document->addValue('find_option', (array)$find_option );
		$varCountStars = $this->request->Value('varCountStars');
		$varCountStars = array_filter((array)$varCountStars);
		$this->document->addValue('varCountStars', $varCountStars );
		$data_filter['intResortID'] = $this->request->getNumber('intResortID',0);
		$data_filter['intRegionID'] = $this->request->getNumber('intRegionID',0);
		$data_filter['intFoodBB'] = $this->request->getNumber('intFoodBB',0);
		$data_filter['intFoodHB'] = $this->request->getNumber('intFoodHB',0);
		$data_filter['intFoodFB'] = $this->request->getNumber('intFoodFB',0);
		$data_filter['intFoodAI'] = $this->request->getNumber('intFoodAI',0);
		$data_filter['intFoodOB'] = $this->request->getNumber('intFoodOB',0);
		//$data_filter['intCountryID'] = $this->request->getNumber('intCountryID',0);
		$data_filter['intVIP'] = $this->request->getNumber('intVIP',0);
		$data_filter['name'] = $this->request->getString('name');
		$this->document->addValue('data_filter', $data_filter );
		
		$sfilter = array();
		if($data_filter['intFoodBB'] != 0){$sfilter['intFoodBB'] = $data_filter['intFoodBB'];}
		if($data_filter['intFoodHB'] != 0){$sfilter['intFoodHB'] = $data_filter['intFoodHB'];}
		if($data_filter['intFoodFB'] != 0){$sfilter['intFoodFB'] = $data_filter['intFoodFB'];}
		if($data_filter['intFoodAI'] != 0){$sfilter['intFoodAI'] = $data_filter['intFoodAI'];}
		if($data_filter['intFoodOB'] != 0){$sfilter['intFoodOB'] = $data_filter['intFoodOB'];}
		if($data_filter['intVIP'] != 0){$sfilter['intVIP'] = $data_filter['intVIP'];}
		if($data_filter['name'] != '' && $data_filter['name'] != 'Название отеля'){$sfilter['LIKEvarName'] = $data_filter['name'];}
		if(!empty($varCountStars)){$sfilter['INvarCountStars'] = implode(',',$varCountStars);}
		
		

		$rel = $this->AdvCountriesTable->GetByFields(array('intParentCountry' => $this->country['intCountryID'], 'isActive'=>1));
		$this->document->addValue('relation', $rel);
		
		$resort = $this->resortsTable->GetList(array('intCountryID'=>$this->country['intCountryID'], 'isActive'=>1), array('varName'=>'ASC'));
		$arr_resort_id = array();
		foreach ($resort as $value) {
			$value['varIdentifier'] = $value['intResortID'];
			$value['varModule'] = 'resorts';
			$value['link'] = LinkCreator::create($value, $this->all_alias);
			$tmp[$value['intResortID']] = $value;
			$arr_resort_id[] = $value['intResortID'];
		}
		$resort = $tmp;
		$tmp = array();
		$region = $this->regionsTable->GetList(array('INintResortID'=>implode(',',$arr_resort_id), 'isActive'=>1), array('varName'=>'ASC'));
		foreach ($region as $value) {
			$value['varIdentifier'] = $value['intRegionID'];
			$value['varModule'] = 'region';
			$value['link'] = LinkCreator::create($value, $this->all_alias);
			$tmp[$value['intRegionID']] = $value;
			$arr_region_id[] = $value['intRegionID'];
		}
		$region = $tmp;
		$tmp = array();
		if($data_filter['intResortID'] != 0){$sfilter['intResortID'] = $data_filter['intResortID'];}
		if($this->sfilter['intCountryID']){$sfilter['intCountryID'] = $this->sfilter['intCountryID'];}
		if(!empty($find_option)){
			$find_hotel_for_option = $this->hotelsOptionTable->getHotelRelation($find_option);
			foreach ($find_hotel_for_option as $key => $value) {
				$arr_hotel[$value['intHotelID']][] = $value['intOptionID'];
			}
			if($arr_hotel){
				foreach ($arr_hotel as $key => $value) {
			   		if(count($find_option) == count($value)){
			   			$diff_arr = array_diff($find_option,$value);
						if(empty($diff_arr)){
							$arr_hotel_ids[] = $key;
						}
					}
				}
			}
			
			$arr_hotel_ids[] = -1;
			$arr_hotel_ids = array_filter($arr_hotel_ids);
			$sfilter['INintHotelID'] = implode(',',$arr_hotel_ids);
		}	
		$sfilter['isActive'] = 1;
		$hotels = $this->hotelsTable->GetList($sfilter, array('varCountStars' => 'DESC', 'varName'=>'ASC'), null, null, 'getSQLRows', true, $this->page, 30);
		
		foreach ($hotels as $key => $value) {
			if($key !== 'pager'){
				$value['varIdentifier'] = $value['intHotelID'];
				$value['varModule'] = 'hotel';
				$value['link'] = LinkCreator::create($value, $this->all_alias);
				$food = array();
				if($value['intFoodBB']==1){$food[] = 'BB';} 	 	 	 	
				if($value['intFoodHB']==1){$food[] = 'HB';}
				if($value['intFoodFB']==1){$food[] = 'FB';}
				if($value['intFoodAI']==1){$food[] = 'ALL, AI';}
				if($value['intFoodOB']==1){$food[] = 'RO, OB';}
				
				$value['Food'] = implode(', ', $food);
				$tmp[$value['intHotelID']] = $value;
				
				$hotelType = $this->HotelsTypesTable->Get($value);
				$varMark = $this->CurrenciesTable->Get($value);
				
				$tmp[$value['intHotelID']]['varHotelType'] = $hotelType['varName'];
				$tmp[$value['intHotelID']]['varMark'] = $varMark['varMark'];
			}else{
				$tmp['pager'] = $value;
			}
		}
		
		$hotels = $tmp;
		$hotel_filter = array();
		if(!empty($arr_region_id)) {
			$hotel_filter['INintRegionID'] = implode(',',$arr_region_id);
		}
		$hotels_tmp = $this->hotelsTable->GetList($hotel_filter);
		foreach ($hotels_tmp as $key => $value) {
			$hotel_ids[]=$value['intHotelID'];
		}
		
		$tmp = array();
		$hotel_ids[] = -1;
		$option_relation = $this->hotelsOptionTable->getOptionRelation($hotel_ids);
		foreach ($option_relation as $key => $value) {
			$tmp[$value['intHotelID']][] = $value['intOptionID'];
			$tmp_unicue[] = $value['intOptionID'];
		}
		$option_relation = $tmp;
		$this->document->addValue('option_relation', $option_relation );
		
		$tmp = array();
		$tmp_unicue[] = -1;
		$option = $this->hotelsOptionTable->GetList(array('INintOptionID'=>implode(',',$tmp_unicue)), array('intOrdering'=>'ASC'));
		foreach ($option as $key => $value) {
			$tmp[$value['intOptionID']] = $value;
			$line_option[] = $value;
		}
		$option = $tmp;
		$this->document->addValue('options', $option );
		$co = count($line_option);
		for($i=0;$i<$co;$i=$i+4){
			if(isset($line_option[$i])){ $options_unic[1][] = $line_option[$i]; }
			if(isset($line_option[$i+1])){ $options_unic[2][] = $line_option[$i+1]; }
			if(isset($line_option[$i+2])){ $options_unic[3][] = $line_option[$i+2]; }
			if(isset($line_option[$i+3])){ $options_unic[4][] = $line_option[$i+3]; }
		}
		$this->document->addValue('options_unic', $options_unic );
		
		
		$this->data['country'] = $this->country;
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('resort', $resort);	
		$this->document->addValue('region', $region);	
		$this->document->addValue('hotel', $hotels);	
		$this->document->addValue('stars', $this->stars);	
		$this->document->addValue('data', $this->data);
		
		$this->curCountryID = $this->country['intCountryID'];
		$this->curResortID = '';
		$this->curRegionID = '';
		$this->curMenuName = $this->country['varName'];
		$this->addDataCountries('country');

		// $resort = reset($resort);
		// $region = reset($region);
		
		$this->breadCrumbs = array(
			array(
				'title'=>'Главная',
				'url'=>'/',
				'thisPage'=>false
			),
			array(
				'title'=>$this->country['varName'],
				'url'=>LinkCreator::create(array('varIdentifier'=>$this->country['intCountryID'], 'varModule'=>'country'), $this->all_alias),
				'thisPage'=>false
			),
			array(
				'title'=>'Отели ('.$this->country['varName'].')',
				'url'=>'',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);	
		
	}
}

Kernel::ProcessPage(new IndexPage("hotels.tpl"));