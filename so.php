<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.SpecialOffersTable");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.PromotionsTypesTable");
Kernel::Import("classes.data.ModulesPagesTable");
Kernel::Import("classes.data.DepartureCitiesTable");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.PagesToCountriesTable");
Kernel::Import("classes.data.PagesTable");
Kernel::Import("classes.data.MenuCountriesTable");
Kernel::Import("classes.data.TblToursTable");
Kernel::Import("classes.data.TblTurServicesTable");
Kernel::Import("classes.data.TblSpoDataTable");

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
	 * @var ModulesPagesTable
	 */
	var $modulesPagesTable;
	/**
	 * @var DepartureCitiesTable
	 */
	var $departureCitiesTable;
	/**
	 * @var RegionsTable
	 */
	var $regionsTable;
	/**
	 * @var PagesToCountriesTable
	 */
	var $pagesToCountriesTable;
	/**
	 * @var PagesTable
	 */
	var $pagesTable;
	/**
	 * @var MenuCountriesTable
	 */
	var $menuCountriesTable;
	
	var $tblToursTable;
	/**
	 * @var TblTurServicesTable
	 */
	var $tblTurServicesTable;
	/**
	 * @var TblSpoDataTable
	 */
	var $tblSpoDataTable;
	
	var $data;
	var $curCountryID;
	var $sfilter = array();
	var $intDepadtureCityID;
	
	function index() {
		parent::index();

		$this->specialOffersTable = new SpecialOffersTable($this->connection);
		$this->countriesTable = new CountriesTable($this->connection);
		$this->promotionsTypesTable = new PromotionsTypesTable($this->connection);
		$this->modulesPagesTable = new ModulesPagesTable($this->connection);
		$this->departureCitiesTable = new DepartureCitiesTable($this->connection);
		$this->regionsTable = new RegionsTable($this->connection);
		$this->pagesToCountriesTable = new PagesToCountriesTable($this->connection);
		$this->pagesTable = new PagesTable($this->connection);
		$this->menuCountriesTable = new MenuCountriesTable($this->connection);
		
		$intCountryID = $this->request->getNumber('intCountryID', 0);
		if(!empty($intCountryID)) {
			$country = $this->countriesTable->Get(array('intCountryID' => $intCountryID));
			$this->setPageTitle('Страны | '.$country['varName'], $country['varMetaKeywords'], $country['varMetaDescription']);
		} else {
			$fields = $this->modulesPagesTable->GetByFields(array('varPage' => 'countries'), null, true);
			$this->setPageTitle($fields['varMetaTitle'], $fields['varMetaKeywords'], $fields['varMetaDescription']);
			$this->setPageTitle('Страны');
		}
		$this->curCountryID = $intCountryID;
		$this->data = $this->countriesTable->Get(array('intCountryID' => $intCountryID));
		if (empty($this->data)) $this->response->redirect('/');
		
		$this->setFilters();
	}
	
	function setFilters() {
		$this->sfilter['isShow'] = 1;
		$this->sfilter['intCountryID'] = $this->data['intCountryID'];
		$this->intDepadtureCityID = $this->request->getNumber('intDepadtureCityID');
		if (!empty($this->intDepadtureCityID)) $this->sfilter['intDepadtureCityID'] = $this->intDepadtureCityID;
	}
	
	function render() {
		parent::render();
		
		// регионы
		$this->document->addValue('so_regions', $this->regionsTable->GetList(array('intCountryID' => $this->data['intCountryID'])));
		
		// инфо
		$this->document->addValue('pages_to_countries', $this->pagesToCountriesTable->GetList(array('intCountryID' => $this->data['intCountryID'])));
		$this->document->addValue('pages_list', $this->pagesTable->GetList());
		
		// навигация
		if (!$this->isAuthorizated) {
			$menuCountries = $this->menuCountriesTable->GetList(array('intCountryID' => $this->data['intCountryID'], 'addToSO' => 1, 'isVisible' => 1, 'isAuthorized' => $this->isAuthorizated), array('intSortOrder' => 'ASC'));
		} else {
			$menuCountries = $this->menuCountriesTable->GetList(array('intCountryID' => $this->data['intCountryID'], 'addToSO' => 1, 'isVisible' => 1), array('intSortOrder' => 'ASC'));
		}
		$this->document->addValue('so_nav', $menuCountries);
	
		// get special offers
		$spOff = $this->specialOffersTable->GetList($this->sfilter, array('intPromotionTypeID'=>'ASC'));
		$countries = $this->countriesTable->GetList();
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
			for ($i = 0; $i < count($tmp); $i++) {
				if ($value['intCountryID'] == $tmp[$i]) {
					foreach ($countries as $k => $val) {
						if ($val['intCountryID'] == $value['intCountryID']) {
							$tmpArr = $value;
							$tourMT = $this->tblToursTable->GetByFields(array('TO_Key' => $value['intSpecOffIDMT']), null, false);
							$tmpArr['varDateFromMT'] = strtotime($tourMT[0]['TO_DateBegin']);
							$tmpArr['varDateToMT'] = strtotime($tourMT[0]['TO_DateEnd']);
							$tmpArr['trKey'] = intval($tourMT[0]['TO_TRKey']);
							$temp = $this->tblTurServicesTable->GetByFields(array('TS_TRKEY' => $tmpArr['trKey']), null, false);
							$tmps = array();
							foreach ($temp as $ke => $va) {
								$t = iconv('WINDOWS-1251', 'UTF-8', $va['TS_NAME']);
								$t_pos = strpos($t,"::");
								if($t_pos===false){
									$tmps[] = $t;
								}else{
									$tmps[] = substr($t,0,$t_pos);
								}
							}
							$tmpArr['trService'] = implode(', ',array_unique($tmps));
							$temp = $this->tblSpoDataTable->GetByFields(array('sd_tourkey' => $tmpArr['intSpecOffIDMT']), null, false);
							foreach ($temp as $ke => $va) {
								$tmpArr['trHotels'] .= iconv('WINDOWS-1251', 'UTF-8', $va['sd_hdname']).'('.iconv('WINDOWS-1251', 'UTF-8', $va['sd_ctname']).') '.$va['sd_hdstars'].'; ';
							}
							
							$tmpArr['ext'] = end(explode('.',$value['varFile']));
							$resArr[$val['varName']][] = $tmpArr;
						}
					}
				}	
			}
		}
		
		$this->document->addValue('special_offers', $resArr);
		$this->document->addValue('promotion_types', $pt);
		$this->document->addValue('departure_cities', $this->departureCitiesTable->GetList());
		$this->document->addValue('curCountryID', $this->curCountryID);
		$this->document->addValue('intDepadtureCityID', $this->intDepadtureCityID);
		$this->document->addValue('data', $this->data);
	}
}

Kernel::ProcessPage(new IndexPage("so.tpl"));