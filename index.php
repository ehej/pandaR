<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.SpecialOffersTable");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.PromotionsTypesTable");
Kernel::Import("classes.data.SPOEditorsTable");
Kernel::Import("classes.data.ModulesPagesTable");
Kernel::Import("classes.data.NewsTable");
Kernel::Import("classes.data.TblToursTable");
Kernel::Import("classes.data.SpoPreferencesTable");
Kernel::Import("classes.data.TblTpServicesTable");
Kernel::Import("classes.data.TblTurServicesTable");
Kernel::Import("classes.data.TblSpoDataTable");
Kernel::Import("classes.data.DepartureCitiesTable");
Kernel::Import("classes.data.SettingsTable");
Kernel::Import("classes.data.FoodTypesTable");
Kernel::Import("classes.data.PlaceTypesTable");

class IndexPage extends PublicPage { 

	/**
	 * @var SpecialOffersTable
	 */
	var $specialOffersTable;
	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	/**
	 * @var PromotionsTypesTable
	 */
	var $promotionsTypesTable;
	/**
	 * @var SPOEditorsTable
	 */
	var $SPOEditorsTable;
	/**
	 * @var ModulesPagesTable
	 */
	var $modulesPagesTable;
	/**
	 * @var TblToursTable
	 */
	var $tblToursTable;
	/**
	 * @var SpoPreferencesTable
	 */
	var $spoPreferencesTable;
	/**
	 * @var TblTpServicesTable
	 */
	var $tblTpServicesTable;
	/**
	 * @var TblTurServicesTable
	 */
	var $tblTurServicesTable;
	/**
	 * @var TblSpoDataTable
	 */
	var $tblSpoDataTable;
	/**
	 * @var DepartureCitiesTable
	 */
	var $departureCitiesTable;
	
	var $sfilter = array();
	var $intDepadtureCityID;
	
	function index() {
		parent::index();

		$this->specialOffersTable = new SpecialOffersTable($this->connection);
		$this->countriesTable = new CountriesTable($this->connection);
		$this->promotionsTypesTable = new PromotionsTypesTable($this->connection);
		$this->SPOEditorsTable = new SPOEditorsTable($this->connection);
		$this->modulesPagesTable = new ModulesPagesTable($this->connection);
		$this->newsTable = new NewsTable($this->connection);
		$this->settingsTable = new SettingsTable($this->connection);
		$this->spoPreferencesTable = new SpoPreferencesTable($this->connection);
		$this->departureCitiesTable = new DepartureCitiesTable($this->connection);
		$this->FoodTypesTable = new FoodTypesTable($this->connection);
		$this->PlaceTypesTable = new PlaceTypesTable($this->connection);
		$this->ToursTransportTable = new ToursTransportTable($this->connection);
		$fields = $this->modulesPagesTable->GetByFields(array('varPage' => 'index'), null, true);
		$this->setPageTitle($fields['varMetaTitle'], $fields['varMetaKeywords'], $fields['varMetaDescription']);
		$this->setFilters();
	}

	function setFilters() {
		$this->sfilter['isShow'] = 1;
		$this->intDepadtureCityID = $this->request->getNumber('intDepadtureCityID');
		if (!empty($this->intDepadtureCityID)) $this->sfilter['intDepadtureCityID'] = $this->intDepadtureCityID;
	}
	
	function OnGetSO() {	
		$smarty = new Smarty();
	  	$smarty->template_dir = TEMPLATES_PATH.'public/';
	  	$smarty->compile_dir = PROJECT_CACHE.'smarty/';
	  	$smarty->config_dir = TEMPLATES_PATH.'public/';
	  	$smarty->cache_dir = PROJECT_CACHE.'smarty/';
	  	$smarty->caching = (int)ENABLE_TEMPLATES_CACHE;
	  	$smarty->cache_lifetime = 1;
	  	$smarty->debugging = ENABLE_INTERNAL_DEBUG;
	  	
		// get special offers
		$spOff = $this->specialOffersTable->GetList($this->sfilter, array('intCountryID' => 'ASC'));
		$countries = $this->countriesTable->GetList();
		//$smarty->assign('countries', $countries);
		$resArr = array();
		$tmp = array();
		foreach ($spOff as $key => $value) {
			$tmp[] = $value['intCountryID'];
		}
		$tmp = array_unique($tmp);
		
		foreach ($spOff as $key => $value) {
			foreach ($countries as $k => $val) {
				if ($val['intCountryID'] == $value['intCountryID']) {
					$tmpArr = $value;
					$tourMT = $this->tblToursTable->GetByFields(array('TO_Key' => $value['intSpecOffIDMT']), null, false);
					$tmpArr['varDateFromMT'] = strtotime($tourMT[0]['TO_DateBegin']);
					$tmpArr['varDateToMT'] = strtotime($tourMT[0]['TO_DateEnd']);
					$tmpArr['trKey'] = intval($tourMT[0]['TO_TRKey']);
					$temp = $this->tblTurServicesTable->GetByFields(array('TS_TRKEY' => $tmpArr['trKey']), null, false);
					foreach ($temp as $ke => $va) {
						$tmpArr['trService'] .= iconv('WINDOWS-1251', 'UTF-8', $va['TS_NAME']).'<br />';
					}
					$temp = $this->tblSpoDataTable->GetByFields(array('sd_tourkey' => $tmpArr['intSpecOffIDMT']), null, false);
					foreach ($temp as $ke => $va) {
						$tmpArr['trHotels'] .= iconv('WINDOWS-1251', 'UTF-8', $va['sd_hdname']).'('.iconv('WINDOWS-1251', 'UTF-8', $va['sd_ctname']).') '.$va['sd_hdstars'].'; ';
					}
					$resArr[$val['varName']][] = $tmpArr;
				}
			}
		}
		$smarty->assign('special_offers', $resArr);
		$smarty->assign('departure_cities', $this->departureCitiesTable->GetList());
		$smarty->assign('intDepadtureCityID', $this->intDepadtureCityID);
		$smarty->assign('promotion_types', $this->promotionsTypesTable->GetList());

		echo $smarty->fetch('so_ajax.tpl');
		die;
	}
	
	function render() {
		parent::render();
		$this->insertForm($content);
		// get special offers
		$spOff = $this->specialOffersTable->GetList($this->sfilter, array('intCountryID' => 'ASC','intPromotionTypeID'=>'ASC'));
		$countries = $this->countriesTable->GetList();
		//$this->document->addValue('countries', $countries);
		$resArr = array();
		$tmp = $this->promotionsTypesTable->GetList();
		foreach($tmp as $v){
			$pt[$v['intPromotionTypeID']]=$v;
		}
		$tmp = array();
		foreach ($spOff as $key => $value) {
			$tmp[] = $value['intCountryID'];
		}
		$tmp = array_unique($tmp);
		
		foreach ($spOff as $key => $value) {
			foreach ($countries as $k => $val) {
				if ($val['intCountryID'] == $value['intCountryID']) {
					$tmpArr = $value;
					//$tourMT = $this->tblToursTable->GetByFields(array('TO_Key' => $value['intSpecOffIDMT']), null, false);
					$tmpArr['varDateFromMT'] = strtotime($tourMT[0]['TO_DateBegin']);
					$tmpArr['varDateToMT'] = strtotime($tourMT[0]['TO_DateEnd']);
					$tmpArr['trKey'] = intval($tourMT[0]['TO_TRKey']);
					//$temp = $this->tblTurServicesTable->GetByFields(array('TS_TRKEY' => $tmpArr['trKey']), null, false);
					$tmps = array();
					if($temp){
						foreach ($temp as $ke => $va) {
							$t = iconv('WINDOWS-1251', 'UTF-8', $va['TS_NAME']);
							$t_pos = strpos($t,"::");
							if($t_pos===false){
								$tmps[] = $t;
							}else{
								$tmps[] = substr($t,0,$t_pos);
							}
						}
					}
					$tmpArr['trService'] = implode(', ',array_unique($tmps));
					//$temp = $this->tblSpoDataTable->GetByFields(array('sd_tourkey' => $tmpArr['intSpecOffIDMT']), null, false);
					if($temp){
						foreach ($temp as $ke => $va) {
							$tmpArr['trHotels'] .= iconv('WINDOWS-1251', 'UTF-8', $va['sd_hdname']).'('.iconv('WINDOWS-1251', 'UTF-8', $va['sd_ctname']).') '.$va['sd_hdstars'].'; ';
						}
					}
					$ex = explode('.',$value['varFile']);
					$tmpArr['ext'] = end($ex);
					$resArr[$val['varName']][] = $tmpArr;
				}
			}
		}
		
		$tmpctours = $this->ToursTable->GetList(array('isVisible'=>1, 'isIndex'=>1, 'OrderBy'=>'country'), array('varCountryName' => 'ASC'), null, 'GetListWithNamesPublic');

			//GROUP_CONCAT(DISTINCT pt.varName ORDER by pt.varName SEPARATOR ', ') as varFoodTypeName,
			//GROUP_CONCAT(DISTINCT c.varName ORDER by c.varName SEPARATOR ', ') as varHotelName,
			//GROUP_CONCAT(DISTINCT r.varName ORDER by r.varName SEPARATOR ', ') as varResortName,
			//GROUP_CONCAT(DISTINCT tr.varTransport ORDER by tr.varTransport SEPARATOR ', ') as varTransport,
			//GROUP_CONCAT(DISTINCT ft.varName ORDER by ft.varName SEPARATOR ', ') as varPlaceTypeName,
		$this->FoodTypesTable = new FoodTypesTable($this->connection);
		$this->PlaceTypesTable = new PlaceTypesTable($this->connection);
		foreach($tmpctours as $key => $tour) {
			$tour['varFoodTypeName'] = implode(',',$this->FoodTypesTable->getByTour($tour['intTourID']));
			$tour['varPlaceTypeName'] = implode(',',$this->PlaceTypesTable->getByTour($tour['intTourID']));
			$tour['varHotelName'] = implode(',',$this->hotelsTable->getByTour($tour['intTourID']));
			$tour['varResortName'] = implode(',',$this->ResortsTable->getByTour($tour['intTourID']));
			$tour['varTransport'] = implode(',',$this->ToursTransportTable->getByTour($tour['intTourID']));
			$ctours[$tour['varCountryName']]['tour'][] = $tour;
			$ctours[$tour['varCountryName']]['tourCountryUri'] = $tour['tourCountryUri'];
		}

		$this->document->addValue('ctours', $ctours);
		
		$this->document->addValue('special_offers', $resArr);
		$this->document->addValue('departure_cities', $this->departureCitiesTable->GetList());
		$this->document->addValue('intDepadtureCityID', $this->intDepadtureCityID);
		$this->document->addValue('promotion_types', $pt);
		
		$data['isShow'] = 1;
		if(!$this->isAuthorizated) $data['isAuthorized'] = $this->isAuthorizated;
		$tmp = $this->SPOEditorsTable->GetList($data);
		$spo = array();
		$j = 0;
		for ($i = 0; $i < count($tmp); $i++) {
			if ($i%4 == 0) $j++;
			$spo[$j][] = $tmp[$i];
		}
		
		$this->document->addValue('spo', $spo);
		
		$this->document->addValue('fast_search', true);
		$this->document->addValue('enableleftlinks', true);

	}
}


Kernel::ProcessPage(new IndexPage("index.tpl"));
