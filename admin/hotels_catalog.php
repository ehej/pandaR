<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.HotelsTable");
Kernel::Import("classes.data.HotelsOptionTable");

class IndexPage extends AdminPage {
	
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
	 * @var HotelsTable
	 */
	var $hotelsTable;
	/**
	 * @var HotelsOptionTable
	 */
	var $hotelsOptionTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Отели');
		$this->setBoldMenu('hotelsCatalog');
		
		$this->countriesTable = new CountriesTable($this->connection);
		$this->regionsTable = new RegionsTable($this->connection);
		$this->resortsTable = new ResortsTable($this->connection);
		$this->hotelsTable = new HotelsTable($this->connection);
		$this->hotelsOptionTable = new HotelsOptionTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$data = array('intHotelID' => $this->request->getNumber('intHotelID'));
		$this->hotelsTable->Delete($data);
		$this->hotelsOptionTable->deleteOptionRelationOPID($data['intHotelID']);
		$this->addMessage('Отель удален');
		$this->response->redirect('hotels_catalog.php');
	}

	function OnSave() {
		$MTHotelIDs = $this->request->Value('MTHotelID');
		//$MTCountryIDs = $this->request->Value('MTCountryID');

		foreach($MTHotelIDs as $key=>$MTHotelID) {
			$data = array('MTHotelID'=>$MTHotelID, /*'MTCountryID'=>$MTCountryIDs[$key],*/ 'intHotelID'=>$key);
			$this->hotelsTable->Update($data);
		}
		$this->addMessage('Данные успешно сохранены');
		$this->response->redirect('hotels_catalog.php');
	}
	
	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'varName');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varName')) && !empty($name)) $this->sfilter['LIKEvarName'] = $name;
		if ( ($name = $this->request->getNumber('intCountryID')) && !empty($name)) $this->sfilter['intCountryID'] = $name;
		if ( ($name = $this->request->getNumber('intResortID')) && !empty($name)) $this->sfilter['intResortID'] = $name;
		if ( ($name = $this->request->getNumber('intRegionID')) && !empty($name)) $this->sfilter['intRegionID'] = $name;

		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}

	function render() {
		parent::render();
		
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC';
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);
		
		$tmp = $this->countriesTable->GetList(null, array('varName'=>'ASC'));
		foreach($tmp as $v){
			$countries[$v['intCountryID']] = $v;
		}
		$tmp = array();
		if($this->sfilter['intCountryID']){
			$resort_list = $this->resortsTable->GetList(array('intCountryID'=>$this->sfilter['intCountryID']), array('varName'=>'ASC'));
			foreach ($resort_list as $value) {
				$tmp[$value['intResortID']] = $value;
			}
			$resort_list = $tmp;
			$this->document->addValue('resorts_list_filter', $resort_list );
		}
		$tmp = array();
		if($this->sfilter['intResortID']){
			$region_list = $this->regionsTable->GetList(array('intResortID'=>$this->sfilter['intResortID']), array('varName'=>'ASC'));
			foreach ($region_list as $value) {
				$tmp[$value['intRegionID']] = $value;
			}
			$region_list = $tmp;
			$this->document->addValue('regions_list_filter', $region_list );
		}
		$this->document->addValue('countries_list', $countries);
		$tmp = $this->regionsTable->GetList(null, array('varName'=>'ASC'));
		foreach($tmp as $v){
			$regions[$v['intRegionID']] = $v;
		}
		$this->document->addValue('regions_list', $regions);
		$tmp = $this->resortsTable->GetList(null, array('varName'=>'ASC'));
		foreach($tmp as $v){
			$resorts[$v['intResortID']] = $v;
		}
		$this->document->addValue('resorts_list', $resorts);
		
		
		$tmp = array();
		$hotels = $this->hotelsTable->GetList($this->sfilter,$sort, null,'GetWithOrder', null, true, $this->page, DEFAULT_ITEMSPERPAGE);
		
		foreach ($hotels as $key => $value) {
			if(!is_integer($key)){
				$pager = $value;
			}else{
				$value['varIdentifier'] = $value['intHotelID'];
				$value['varModule'] = 'hotel';
				$value['link'] = LinkCreator::create($value, $this->all_alias);
				$tmp[] = $value;
			}
		}
		if(isset($pager))$tmp['pager'] = $pager;

		$hotels = $tmp;	
		
		$this->document->addValue('hotels_list', $hotels);
	}

}

Kernel::ProcessPage(new IndexPage("hotels_catalog.tpl"));
