<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.HotelsTable");
Kernel::Import("classes.data.HotelsOptionTable");
Kernel::Import("classes.data.StaffsTable");
Kernel::Import("classes.data.StaffsContactTable");
Kernel::Import("classes.data.StaffsRelationCoutrysTable");
Kernel::Import("classes.data.CatalogMenuTable");

class IndexPage extends PublicPage {

	var $regionsTable;
	var $hotelsTable;
	var $resortsTable;
	var $StaffsTable;
	var $StaffsContactTable;
	var $StaffsRelationCoutrysTable;
	var $hotelsOptionTable;
	var $CatalogMenuTable;
	var $data;
	
	function index() {
		parent::index();
		
		$this->regionsTable 				= new RegionsTable($this->connection);
		$this->resortsTable					= new ResortsTable($this->connection);		
		$this->hotelsTable 					= new HotelsTable($this->connection);
		$this->StaffsTable 					= new StaffsTable($this->connection);
		$this->StaffsContactTable 			= new StaffsContactTable($this->connection);
		$this->StaffsRelationCoutrysTable 	= new StaffsRelationCountryTable($this->connection);
		$this->hotelsOptionTable 			= new HotelsOptionTable($this->connection);
		$this->CatalogMenuTable 			= new CatalogMenuTable($this->connection);
		
		$intRegionID = $this->request->getNumber('intRegionID', 0);
		
		$varUrlAlias = $this->request->getString('varUrlAlias');
		if(empty($intRegionID)) {
			$intRegionID = LinkCreator::url_to_id('regions',$varUrlAlias,$this->all_alias);
		}
		if ($intRegionID) {
			$this->data = $this->regionsTable->Get(array('intRegionID' => $intRegionID));
			if (empty($this->data)) $this->response->redirect('index.php');
		}

		$tmpurl = explode('/',trim($_SERVER['REQUEST_URI'],'/'));
		if($tmpurl[0] == 'regions') {
			$country = $this->countriesTable->GetByFields(array('varUrlAlias'=>$_REQUEST['varUrlAlias']));
			$this->sfilter['intCountryID'] = $this->data['intCountryID'];
		}

		$this->setPageTitle('Регион | '.$this->data['varName']);
	}

	
	
	function render() {
		$this->curCountryID = $this->sfilter['intCountryID'];
		parent::render();

		$this->document->addValue('FILES_URL', FILES_URL);
		$this->data['varDescription'] = $this->insertForm($this->data['varDescription']);
		$this->document->addValue('data', $this->data);
		
		//table hotels
		$hotels_data = $this->hotelsTable->GetList(array('intRegionID'=>$this->data['intRegionID'], 'isActive'=>1));
		foreach ($hotels_data as $key => $value) {
			$value['varIdentifier'] = $value['intHotelID'];
			$value['varModule'] = 'hotel';
			$value['link'] = LinkCreator::create($value, $this->all_alias);
			$tmp[] = $value; 
			$arr_ids[] = $value['intHotelID'];
			$arr_stars[] = $value['intCountStars'];
		}
		$hotels  = $tmp;	
		
		$tmp = array();
		$option = $this->hotelsOptionTable->GetList(null, array('intOrdering'=>'ASC'));
		foreach ($option as $key => $value) {
			$tmp[$value['intOptionID']] = $value;
		}
		$option = $tmp;
		$this->document->addValue('option', $option );
		
		$arr_ids[] = -1;
		$arr_ids = array_unique($arr_ids);
		$relation_option = $this->hotelsOptionTable->getOptionRelation($arr_ids);
		$tmp = array();
		foreach ($relation_option as $key => $value) {
			$tmp[$value['intHotelID']][] = $value['intOptionID'];
			$arr_option[] = $value['intOptionID'];
		}
		$arr_option = array_unique($arr_option);
		$arr_stars = array_unique($arr_stars);
		$relation_option = $tmp;
		
		foreach ($_REQUEST as $key => $value) {
			if(strtolower($value) == 'y' || strtolower($value) == 'n'){
				$arr_filter[$key] = strtolower($value);
				$value_filter[(int)(str_replace('f_o','',$key))] = strtolower($value);
			}
		}
		$star = $this->request->getNumber('f_cat');
		foreach ($hotels as $key => $value) {
			$flag = true;
			if($star){
				if($star != $value['intCountStars']){
					$flag = false;
				}	
			}
			foreach ($arr_filter as $k => $val) {
				$id_option = (int)(str_replace('f_o','',$k));
				if($val =='y'){
					if(!in_array($id_option, $relation_option[$value['intHotelID']])){
						$flag = false;	
					}	
				}else{
					if(in_array($id_option, $relation_option[$value['intHotelID']])){
						$flag = false;	
					}	
				}
			}
			if($flag){
				$arr_view[] = $value['intHotelID'];
			}
		}

		
		$this->document->addValue('value_filter_star', $star);
		$this->document->addValue('value_filter', $value_filter);
		$this->document->addValue('view_hotel', $arr_view);
		$this->document->addValue('arr_stars', $arr_stars);
		$this->document->addValue('hotels', $hotels);
		$this->document->addValue('arr_option', $arr_option);
		$this->document->addValue('relation_option', $relation_option);
		//$this->document->addValue('curCountryID', $resort_data['intCountryID']);
		//end teble hotels
		
		$tmp = array();

		$this->resort = $this->resortsTable->Get(array('intResortID' => $this->data['intResortID']));
		$this->curCountryID = $this->resort['intCountryID'];
		$this->curResortID = $this->resort['intResortID'];
		$this->curRegionID = $this->data['intRegionID'];
		$this->country = $this->countriesTable->Get(array('intCountryID' => $this->curCountryID));
		$this->curMenuName = $this->resort['varName'];

		$resort = $this->resortsTable->GetList(array('intCountryID'=>$this->curCountryID, 'isActive'=>1));
		foreach ($resort as $value) {
			$value['varIdentifier'] = $value['intResortID'];
			$value['varModule'] = 'resorts';
			$value['link'] = LinkCreator::create($value, $this->all_alias);
			$tmp[$value['intResortID']] = $value;
			$arr_resort_id[] = $value['intResortID'];
		}
		$resort = $tmp;
		$tmp = array();
		$region = $this->regionsTable->GetList(array('INintResortID'=>implode(',',$arr_resort_id), 'isActive'=>1));
		foreach ($region as $value) {
			$value['varIdentifier'] = $value['intRegionID'];
			$value['varModule'] = 'region';
			$value['link'] = LinkCreator::create($value, $this->all_alias);
			$tmp[] = $value;
			$arr_region_id[] = $value['intRegionID'];
		}
		$region = $tmp;
		$this->document->addValue('region', $region);
		
		$this->addDataCountries();	
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
				'title'=>$this->resort['varName'],
				'url'=>LinkCreator::create(array('varIdentifier'=>$this->resort['intResortID'], 'varModule'=>'resort'), $this->all_alias),
				'thisPage'=>false
			),
			array(
				'title'=>''.$this->data['varName'].'',
				'url'=>'',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);	
				
	}
}

Kernel::ProcessPage(new IndexPage("region.tpl"));