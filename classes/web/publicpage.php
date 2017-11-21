<?php

Kernel::Import("system.page.Page");
Kernel::Import('system.response.SmartyResponse');
Kernel::Import('classes.unit.Image');
Kernel::Import("classes.data.PreferencesTable");
Kernel::Import("classes.data.TblCoursesTable");
Kernel::Import("classes.data.MenuTable");
Kernel::Import("classes.data.BannersRightTable");
Kernel::Import("classes.data.NewsTable");
Kernel::Import("classes.data.NewsTypeTable");
Kernel::Import("classes.data.MenuCountriesTable");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.CurrenciesTable");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.HotelsTable");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.BannersToModulesTable");
Kernel::Import("classes.data.BannersMainTable");
Kernel::Import("classes.data.ModulesPagesTable");
Kernel::Import("classes.data.GalleriesToModulesTable");
Kernel::Import("classes.data.GallerysTable");
Kernel::Import("classes.data.ImagesTable");
Kernel::Import("classes.data.CommentsTable");
Kernel::Import("classes.data.PagesTable");
Kernel::Import("classes.data.ContestsTable");
Kernel::Import("classes.data.QuestionsTable");
Kernel::Import("classes.data.AnswersTable");
Kernel::Import("classes.data.BottomLinksTable");
Kernel::Import("classes.data.spoPreferencesTable");
Kernel::Import("classes.data.StaticZonePositionTable");
Kernel::Import("classes.data.StaticZoneTable");
Kernel::Import("classes.data.AdvCountriesTable");
Kernel::Import("classes.data.AdvResortsTable");
Kernel::Import("classes.data.AdvResortsContentTable");
Kernel::Import("classes.data.AttractionsTable");
Kernel::Import("classes.data.OtherInfoTable");
Kernel::Import("classes.data.StaffsTable");
Kernel::Import("classes.data.StaffsContactTable");
Kernel::Import("classes.data.StaffsRelationCoutrysTable");
Kernel::Import("classes.data.CatalogMenuTable");
Kernel::Import("classes.data.CategoryInfoTable");
Kernel::Import("classes.data.SettingsTable");
Kernel::Import("classes.data.ToursTable");
Kernel::Import("classes.data.GeneralGalleryTable");
Kernel::Import("classes.data.TourTypesTable");
Kernel::Import("classes.data.SubscribesTable");
Kernel::Import("classes.unit.FormCreator");
Kernel::Import("classes.data.UsersTable");
Kernel::Import("classes.data.LinksTable");
Kernel::Import("classes.data.HotelsTypesTable");

Kernel::Import("classes.unit.Image");
Kernel::Import("classes.unit.LinkCreator");

Kernel::Import("system.mail.*");

class PublicPage extends Page {
	var $metaDescription;
	var $metaKeywords;
	var $isAuthorizated;
	
	public $menuTable;
	private  $preferencesTable;
	private  $bannersRightTable;
	private  $newsTable;
	public $menuCountriesTable;
	public $countriesTable;
	public $bannersToModulesTable;
	public $bannersMainTable;
	public $modulesPagesTable;
	public $galleriesToModulesTable;
	public $gallerysTable;
	public $pagesTable;
	public $imagesTable;
	public $commentsTable;
	public $contestsTable;
	public $questionsTable;
	public $answersTable;
	public $regionsTable;
	public $ResortsTable;
	public $hotelsTable;
	public $bottomLinksTable;
	public $StaticZoneTable;
	public $StaticZonePositionTable;
	public $AdvCountriesTable;
	public $AdvResortsTable;
	public $AdvResortsContentTable;
	public $NewsTypeTable;
	public $StaffsTable;
	public $StaffsContactTable;
	public $StaffsRelationCoutrysTable;
	public $CatalogMenuTable;
	public $CategoryInfoTable;
	public $LinksTable;
	
	public $AttractionsTable;
	public $OtherInfoTable;
	public $TblCoursesTable;
	public $imageManipulate;
	public $contestPage = 1;
	public $curMenuID;
	public $form;
    public $spoPreferencesTable;
    public $breadCrumbs;
	private $countiesLeftBlockFlag = false;
	private $wtuLeftBlockFlag = false;
		
	public $all_alias;
	
	function __construct($Template) {
		parent::__construct($Template);
		$this->preferencesTable 			= new PreferencesTable($this->connection);
		$this->TblCoursesTable 				= new TblCoursesTable($this->mssql_connection);
		$this->menuTable 					= new MenuTable($this->connection);
		$this->bannersRightTable 			= new BannersRightTable($this->connection);
		$this->newsTable 					= new NewsTable($this->connection);
		$this->NewsTypeTable 				= new NewsTypeTable($this->connection);
		$this->menuCountriesTable 			= new MenuCountriesTable($this->connection);
		$this->countriesTable 				= new CountriesTable($this->connection);
		$this->bannersToModulesTable 		= new BannersToModulesTable($this->connection);
		$this->bannersMainTable 			= new BannersMainTable($this->connection);
		$this->modulesPagesTable 			= new ModulesPagesTable($this->connection);
		$this->galleriesToModulesTable 		= new GalleriesToModulesTable($this->connection);
		$this->gallerysTable 				= new GallerysTable($this->connection);
		$this->imagesTable 					= new ImagesTable($this->connection);
		$this->commentsTable 				= new CommentsTable($this->connection);
		$this->pagesTable 					= new PagesTable($this->connection);
		$this->contestsTable 				= new ContestsTable($this->connection);
		$this->questionsTable 				= new QuestionsTable($this->connection);
		$this->answersTable 				= new AnswersTable($this->connection);
		$this->bottomLinksTable 			= new BottomLinksTable($this->connection);
		$this->regionsTable 				= new RegionsTable($this->connection);
		$this->ResortsTable 				= new ResortsTable($this->connection);
		$this->hotelsTable 					= new HotelsTable($this->connection);
		$this->imageManipulate 				= new Image();
		$this->spoPreferencesTable 			= new spoPreferencesTable($this->connection);
		$this->StaticZoneTable 				= new StaticZoneTable($this->connection);
		$this->StaticZonePositionable 		= new StaticZonePositionTable($this->connection);
		$this->AdvCountriesTable			= new AdvCountriesTable($this->connection);
		$this->AdvResortsTable 				= new AdvResortsTable($this->connection);
		$this->AdvResortsContentTable 		= new AdvResortsContentTable($this->connection);
		$this->AttractionsTable				= new AttractionsTable($this->connection);
		$this->OtherInfoTable 				= new OtherInfoTable($this->connection);
		$this->StaffsTable 					= new StaffsTable($this->connection);
		$this->StaffsContactTable 			= new StaffsContactTable($this->connection);
		$this->StaffsRelationCoutrysTable 	= new StaffsRelationCountryTable($this->connection);	
		$this->CatalogMenuTable 			= new CatalogMenuTable($this->connection);
		$this->ToursTable 					= new ToursTable($this->connection);
		$this->tourtypesTable 				= new TourTypesTable($this->connection);
		$this->settingsTable 		    	= new SettingsTable($this->connection);
		$this->currenciesTable 		    	= new CurrenciesTable($this->connection);
		$this->generalgalleryTable			= new GeneralGalleryTable($this->connection);
		$this->subscribesTable				= new subscribesTable($this->connection);
		$this->CategoryInfoTable			= new CategoryInfoTable($this->connection);
		$this->usersTable					= new UsersTable($this->connection);
		$this->LinksTable					= new LinksTable($this->connection);
		
		$this->form = new FormCreator($this->connection);
		
		$this->setTemplatesRoot('public/');
		
		$fileName = basename($_SERVER['SCRIPT_NAME'], '.php');
		if ($fileName == 'countries') {
			$this->countiesLeftBlockFlag = true;
		}
		// authenticate
		 $this->authenticate();
		 
		$this->setResponse(new SmartyResponse($this, $this->document));
		
		// set main layout
		/*if ($fileName == 'hotel' || $fileName == 'hotel_gallery') {
			$this->response->maintemplate = "layout_hotel.tpl";
		} else {*/
			$this->response->maintemplate = "layout.tpl";
		//}
		
		$this->all_alias = $this->getUrlAlias();
		//$this->memcache = new Memcache;
		//$this->memcache->connect(MEMCACHE_HOST, MEMCACHE_PORT) or die ("Could not connect");
	}
 	
	public function OnLogon() {
		$user = $this->usersTable->GetByFields(array('varLogin'=>$this->request->getString('varLogin'), 'varPassword'=>$this->request->getString('varPassword')));
		if($user) {
			if(!$user['intValid']) {
				$this->addErrorMessage('Подтвердите Ваш e-mail, перейдя по ссылке, отправленной Вам.' );
				$this->response->redirect($_SERVER['HTTP_REFERER']);
				return;
			}
			if(!$user['isActive']) {
				$this->addErrorMessage('Ваш аккаунт не одобрен администратором.' );
				$this->response->redirect($_SERVER['HTTP_REFERER']);
				return;
			}
			$_SESSION['USER_DATA'] = $user;
		} else {
			$this->addErrorMessage('Неправильно указан логин или пароль.' );
			$this->response->redirect($_SERVER['HTTP_REFERER']);
		}
		$this->response->redirect($_SERVER['HTTP_REFERER']);
	}

	function OnValidation() {
		$datacode = $this->request->getString('code');
		$users = $this->usersTable->GetList();
		foreach($users as $user) {
			if($datacode == md5($user['varEmail'].'publicKEY'.$user['intUserID'].$user['varCreatedTime'].'ValidatioN')) {
				$data = array('intUserID'=>$user['intUserID'], 'intValid'=>1);
				$this->usersTable->Update($data);
				$this->addMessage('Вы успешно подтвердили свой Email.');
				$this->response->redirect('/');
			}
		}
	}
	
	function OnLogout() {
		unset($_SESSION['USER_DATA']);
		$this->response->redirect('/');
	}
	
	function authenticate() {
		$tmp = $this->session->Get('USER_DATA');
		if (!empty($tmp)) {
			$this->isAuthorizated = '1';
			$this->document->addValue('USER_DATA', '1');
		} else {
			$this->document->addValue('USER_DATA', '0');
			$this->isAuthorizated = '0';
		}
		return $tmp;
	}
	
	function _encodeHeader($input, $charset = 'ISO-8859-1') {
        preg_match_all('/(\s?\w*[\x80-\xFF]+\w*\s?)/', $input, $matches);
        foreach ($matches[1] as $value) {
            $replacement = preg_replace('/([\x20\x80-\xFF])/e', '"=" . strtoupper(dechex(ord("\1")))', $value);
            $input = str_replace($value, '=?' . $charset . '?Q?' . $replacement . '?=', $input);
        }

        return $input;
    }

	function setPageTitle($title, $metakeywords=null, $metadescription=null) {
		$this->document->addValue('pagetitle', $title);
		$this->document->addValue('metakeywords', $metakeywords);
		$this->document->addValue('metadescription', $metadescription);
		
		$tmp = $this->session->Get('pages');
		if(is_array($tmp) && count($tmp) > 0) {
			foreach($tmp as $key => $value) {
				if($value['title'] == $title) { 
					array_splice($tmp, $key, 1);
					break;	
				}
			}
			if(count($tmp) > 3) array_shift($tmp);
			array_push($tmp, array('url' => $this->getCurPageURL(), 'title' => $title));
			$this->session->Set('pages', $tmp);
		} else {
			$this->session->Set('pages', array(0 => array('url' => $this->getCurPageURL(), 'title' => $title)));
		}
	}

	function getCurPageURL() {
	 	$pageURL = 'http';
	 	if ($_SERVER["HTTPS"] == "on") {
	 		$pageURL .= "s";
	 	}
	 	$pageURL .= "://";
	 	if ($_SERVER["SERVER_PORT"] != "80") {
	  		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 	} else {
	  		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 	}
	 	return $pageURL;
	}
	
	function getCurPageName() {
 		return substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
	}
	
	function addErrorMessage($message) {
		$this->addMessage($message, true);
	}

	function addMessage($message, $error = false) {
		$messages = $this->session->Get('messages');
		$messages = is_null($messages)? array() : $messages;
		$messages[] = array('msg' => $message, 'error' => $error);
		$this->session->Set('messages', $messages);
	}

	function writeMessages() {
		$messages = $this->session->Get('messages');
		if( is_array($messages) && count($messages) ) {
			$this->document->addValue('messages', $messages);
			$this->session->Set('messages', array());
		}
	}

	function hasErrorMessages() {
		$messages = $this->session->Get('messages');
		$messages = is_null($messages)? array() : $messages;
		foreach ($messages as $msg) {
			if ($msg['error']) return true;
		}
		return false;
	}

	function getSessionID() {
		return PROJECT_SESSION_NAME . 'user';
	}
	
	private function getCurrency($gtd) {
		$koeff = $this->preferencesTable->GetList();
		if(count($koeff) > 0) $koeff = $koeff[count($koeff) - 1]['varPrefValue'];
		$curDate = getdate(time());
		$curMon = ($curDate['mon'] < 10) ? '0'.$curDate['mon'] : $curDate['mon'];
		$curDay = ($curDate['mday'] < 10) ? '0'.$curDate['mday'] : $curDate['mday'];
		foreach($gtd as $key => $value) {
			$tmp = getdate(strtotime($value['RC_DATEEND']));
			$mon = ($tmp['mon'] < 10) ? '0'.$tmp['mon'] : $tmp['mon'];
			$day = ($tmp['mday'] < 10) ? '0'.$tmp['mday'] : $tmp['mday'];
			if($mon == $curMon && $day == $curDay) {
				$course = $value['RC_COURSE'] * $koeff['varPrefValue'] / 100 + $value['RC_COURSE'];
				//$str = substr($course, 0, strpos($course, '.'));
				//echo($str .= '.'.substr($course, strpos($course, '.') + 1, 4));
				return $str = round($course, 4);
			}
		}
	}
	
	/**
	 * Изменить размер изображения
	 * @param String $image
	 * @param String $size (WIDTHxHEIGHT)
	 * @return URL
	 */
	private function getImageUrl($image, $size = null, $path_type = null) {
		if($path_type == 'obs'){
			$path_start = str_replace(PROJECT_URL,'/',IMAGES_URL);
		}else{
			$path_start = IMAGES_URL;
		}
		
		if ( ! empty($size)) {
			$path = IMAGES_PATH.substr($image,0,3)."/".$size."/".$image;
			if ( ! file_exists($path)) {
				$path = substr($image,0,3)."/".$image;
				$this->imageManipulate->resize($path, $size);
			}
			$path = $path_start.substr($image,0,3)."/".$size."/".$image;
		} else {
			$path = $path_start.substr($image,0,3)."/".$image;
		}
		return $path;
	}
	
	public function OnComment() {
		$captcha = $this->request->getString('Captcha', 'NotEmpty');
		$data['varName'] = $this->request->getString('varName', 'NotEmpty');
		$data['varComment'] = $this->request->getString('varComment', 'NotEmpty');
		$data['isActive'] = 0;
		$data['varIsNew'] = 'yes';
		$data['varDate'] = time();
		
		if ($captcha != $this->session->Get('captcha_keystring')) {
			$this->addErrorMessage('Не верный цифровой код');
			$this->document->addValue('commentData', $data);
			$this->document->addValue('commentFlag', 'false');
		} else {
			if (!$this->request->getErrors()) {
				$fileName = basename($_SERVER['SCRIPT_NAME'], '.php');
				$modPageData = $this->modulesPagesTable->GetByFields(array('varPage' => $fileName));
				
				switch($fileName) {
  			   		case 'news'	: 	{
							$intNewsID = $this->request->getNumber('intNewsID');
							if (!empty($intNewsID)) {
								$data['varModuleName'] = 'news';
								$data['intModuleID'] = $intNewsID;
							}
							break;
						}
			   		case 'news_archive'	: 	{
							$data['varModuleName'] = 'news_archive';
							$data['intModuleID'] = $modPageData['intModulePageID'];
							break;
						}
					case 'category_news'	: 	{
							$intNewsTypeID = $this->request->getNumber('intNewsTypeID');
							$varUrlAlias = $this->request->getString('varUrlAlias');
							if(empty($intNewsTypeID)) {
								$intNewsTypeID = LinkCreator::url_to_id('news_type',$varUrlAlias,$this->all_alias);
							}
							if (!empty($intNewsTypeID)) {
								$data['varModuleName'] = 'category_news';
								$data['intModuleID'] = $intNewsTypeID;
							}
							break;
						}
					case 'so'	: 	{
							$data['varModuleName'] = 'so';
							$data['intModuleID'] = $intPageID;
							break;
						}
					case 'about_country'	: 	{
							$intCountryID = $this->request->getNumber('intCountryID', 0);
							$varUrlAlias = $this->request->getString('varUrlAlias');
							if(empty($intCountryID)) {
								$intCountryID = LinkCreator::url_to_id('countries',$varUrlAlias,$this->all_alias);
							}
							if (!empty($intCountryID)) {
								$data['varModuleName'] = 'about_country';
								$data['intModuleID'] = $intCountryID;
							}
							break;
						}
					case 'resorts'	: 	{
							$intCountryID = $this->request->getNumber('intCountryID', 0);
							$varUrlAlias = $this->request->getString('varUrlAlias');
							if(empty($intCountryID)) {
								$intCountryID = LinkCreator::url_to_id('countries',$varUrlAlias,$this->all_alias);
							}
							if (!empty($intCountryID)) {
								$data['varModuleName'] = 'resorts';
								$data['intModuleID'] = $intCountryID;
							}
							break;
						}
					case 'regions'	: 	{
							$intCountryID = $this->request->getNumber('intCountryID', 0);
							$varUrlAlias = $this->request->getString('varUrlAlias');
							if(empty($intCountryID)) {
								$intCountryID = LinkCreator::url_to_id('countries',$varUrlAlias,$this->all_alias);
							}
							if (!empty($intCountryID)) {
								$data['varModuleName'] = 'regions';
								$data['intModuleID'] = $intCountryID;
							}
							break;
						}
					case 'hotels'	: 	{
							$intCountryID = $this->request->getNumber('intCountryID', 0);
							$varUrlAlias = $this->request->getString('varUrlAlias');
							if(empty($intCountryID)) {
								$intCountryID = LinkCreator::url_to_id('countries',$varUrlAlias,$this->all_alias);
							}
							if (!empty($intCountryID)) {
								$data['varModuleName'] = 'hotels';
								$data['intModuleID'] = $intCountryID;
							}
							break;
						}
					case 'resort'	: 	{
							$intResortID = $this->request->getNumber('intResortID', 0);
							$varUrlAlias = $this->request->getString('varUrlAlias');
							if(empty($intResortID)) {
								$intResortID = LinkCreator::url_to_id('resorts',$varUrlAlias,$this->all_alias);
							}
							if (!empty($intResortID)) {
								$data['varModuleName'] = 'resort';
								$data['intModuleID'] = $intResortID;
							}
							break;
						}
					case 'region'	: 	{
							$intRegionID = $this->request->getNumber('intRegionID', 0);
							$varUrlAlias = $this->request->getString('varUrlAlias');
							if(empty($intRegionID)) {
								$intRegionID = LinkCreator::url_to_id('regions',$varUrlAlias,$this->all_alias);
							}
							if (!empty($intRegionID)) {
								$data['varModuleName'] = 'region';
								$data['intModuleID'] = $intRegionID;
							}
							break;
						}
					case 'hotel_gallery'	: 	{
							$intHotelID = $this->request->getNumber('intHotelID', 0);
							$varUrlAlias = $this->request->getString('varUrlAlias');
							if(empty($intHotelID)) {
								$intHotelID = LinkCreator::url_to_id('hotels',$varUrlAlias,$this->all_alias);
							}
							if (!empty($intHotelID)) {
								$data['varModuleName'] = 'hotel_gallery';
								$data['intModuleID'] = $intHotelID;
							}
							break;
						}
					case 'hotel'	: 	{
							$intHotelID = $this->request->getNumber('intHotelID', 0);
							$varUrlAlias = $this->request->getString('varUrlAlias');
							if(empty($intHotelID)) {
								$intHotelID = LinkCreator::url_to_id('hotels',$varUrlAlias,$this->all_alias);
							}
							if (!empty($intHotelID)) {
								$data['varModuleName'] = 'hotel';
								$data['intModuleID'] = $intHotelID;
							}
							break;
						}
					case 'country'	: 	{
							$intCountryID = $this->request->getNumber('intCountryID', 0);
							$varUrlAlias = $this->request->getString('varUrlAlias');
							if(empty($intCountryID)) {
								$intCountryID = LinkCreator::url_to_id('countries',$varUrlAlias,$this->all_alias);
							}
							if (!empty($intCountryID)) {
								$data['varModuleName'] = 'country';
								$data['intModuleID'] = $intCountryID;
							}
							break;
						}
					case 'countries'	: 	{
							$data['varModuleName'] = 'countries';
							$data['intModuleID'] = 1;
							break;
						}
					case 'promoakciya'	: 	{
							$intPromoID = $this->request->getNumber('intPromoID', 0);
							if (!empty($intPromoID)) {
								$data['varModuleName'] = 'promoakciya';
								$data['intModuleID'] = $intPromoID;
							}
							break;
						}
					case 'adv_country'	: 	{
							$intCountryID = $this->request->getNumber('intCountryID', 0);
							$varUrlAlias = $this->request->getString('varUrlAlias');
							if(empty($intCountryID)) {
								$intCountryID = LinkCreator::url_to_id('AdvCountries',$varUrlAlias,$this->all_alias);
							}
							if (!empty($intCountryID)) {
								$data['varModuleName'] = 'adv_country';
								$data['intModuleID'] = $intCountryID;
							}
							break;
						}
					case 'adv_resort'	: 	{
							$intResortID= $this->request->getString('intResortID');
							$varUrlAlias = $this->request->getString('varUrlAlias');
							if(empty($intResortID)) {
								$intResortID = LinkCreator::url_to_id('AdvResorts',$varUrlAlias,$this->all_alias);
							}
							if (!empty($intResortID)) {
								$data['varModuleName'] = 'adv_resort';
								$data['intModuleID'] = $intResortID;
							}
							break;
						}
					case 'adv_resort_content'	: 	{
							$intResortContentID = $this->request->getString('intResortContentID');
							$varUrlAlias = $this->request->getString('varUrlAlias');
							if(empty($intResortContentID)) {
								$intResortContentID = LinkCreator::url_to_id('AdvResortsContent',$varUrlAlias,$this->all_alias);
							}
							if (!empty($intResortContentID)) {
								$data['varModuleName'] = 'adv_resort_content';
								$data['intModuleID'] = $intResortContentID;
							}
							break;
						}
					case 'subscribes'	: 	{
							$data['varModuleName'] = 'subscribes';
							$data['intModuleID'] = $modPageData['intModulePageID'];
							break;
						}
					case 'subscribes_add'	: 	{
							$data['varModuleName'] = 'subscribes_add';
							$data['intModuleID'] = $modPageData['intModulePageID'];
							break;
						}
					case 'unsubscribes'	: 	{
							$data['varModuleName'] = 'unsubscribes';
							$data['intModuleID'] = $modPageData['intModulePageID'];
							break;
						}
					case 'feedback'	: 	{
							$data['varModuleName'] = 'feedback';
							$data['intModuleID'] = $modPageData['intModulePageID'];
							break;
						}
					case 'akciya'	: 	{
							$intAkciyID = $this->request->getNumber('intAkciyID', 0);
							if (!empty($intAkciyID)) {
								$data['varModuleName'] = 'akciya';
								$data['intModuleID'] = $intAkciyID;
							}
							break;
						}
					case 'akcii'	: 	{
								$data['varModuleName'] = 'akcii';
								$data['intModuleID'] = $modPageData['intModulePageID'];
							break;
						}
					case 'excursion'	: 	{
							$intExcursionID = $this->request->getNumber('intExcursionID', 0);
							if (!empty($intExcursionID)) {
								$data['varModuleName'] = 'excursion';
								$data['intModuleID'] = $intExcursionID;
							}
							break;
						}
					case 'attraction'	: 	{
							$intAttractionID = $this->request->getNumber('intAttractionID', 0);
							if (!empty($intAttractionID)) {
								$data['varModuleName'] = 'attraction';
								$data['intModuleID'] = $intAttractionID;
							}
							break;
						}
					case 'other_info'	: 	{
							$intInfoID = $this->request->getNumber('intInfoID', 0);
							$varUrlAlias = $this->request->getString('varUrlAlias');
							if(empty($intInfoID)) {
								$intInfoID = LinkCreator::url_to_id('other_info',$varUrlAlias,$this->all_alias);
							}
							if (!empty($intInfoID)) {
								$data['varModuleName'] = 'other_info';
								$data['intModuleID'] = $intInfoID;
							}
							break;
						}
					case 'document'	: 	{
							$data['varModuleName'] = 'document';
							$data['intModuleID'] = $modPageData['intModulePageID'];
							break;
						}
					case 'contacts'	: 	{
							$data['varModuleName'] = 'contacts';
							$data['intModuleID'] = $modPageData['intModulePageID'];
							break;
						}
					case 'contacts_region'	: 	{
							$data['varModuleName'] = 'contacts_region';
							$data['intModuleID'] = $modPageData['intModulePageID'];
							break;
						}
					case 'guest_book'	: 	{
							$data['varModuleName'] = 'guest_book';
							$data['intModuleID'] = $modPageData['intModulePageID'];
							break;
						}
					case 'where_buy'	: 	{
							$data['varModuleName'] = 'where_buy';
							$data['intModuleID'] = $modPageData['intModulePageID'];
							break;
						}
					case 'currency_courses'	: 	{
							$data['varModuleName'] = 'currency_courses';
							$data['intModuleID'] = $modPageData['intModulePageID'];
							break;
						}
					case 'pages'	: 	{
							$intPageID = $this->request->getNumber('intPageID');
							$varUrlAlias = $this->request->getString('varUrlAlias');
							if(empty($data['intPageID'])) {
								$intPageID = LinkCreator::url_to_id('pages',$varUrlAlias,$this->all_alias);
							}
							if (!empty($intPageID)) {
								$data['varModuleName'] = 'pages';
								$data['intModuleID'] = $intPageID;
							}
							break;
						}
					default			:	{
						$data['varModuleName'] = $fileName;
						
						if ($fileName == 'countries') {
							$data['intModuleID'] = $this->request->getNumber('intCountryID');
						} else {
							$modPageData = $this->modulesPagesTable->GetByFields(array('varPage' => $fileName));
							if (!empty($modPageData)) {
								$data['intModuleID'] = $modPageData['intModulePageID'];
							}
						}
						break;
					}	
				}
				
				$this->commentsTable->Insert($data);
				$this->document->addValue('commentFlag', 'true');
			} else {
				$this->document->addValue('commentData', $data);
				$this->document->addValue('commentFlag', 'false');
			}
		}
	}
	
	public function OnContestComplete() {
		if (empty($_POST)) {
			$this->document->addValue('contestFlag', 'true'); 
			return; 
		} 
		$data['contestName'] = $this->request->getString('contestName', 'NotEmpty');
		$data['varFIOContest'] = $this->request->getString('varFIOContest', 'NotEmpty');
		$data['varCompanyNameContest'] = $this->request->getString('varCompanyNameContest', 'NotEmpty');
		$data['varCityContest'] = $this->request->getString('varCityContest', 'NotEmpty');
		$data['varPostArrdContest'] = $this->request->getString('varCityContest');
		$data['varEmailContest'] = $this->request->getString('varEmailContest', 'NotEmpty');
		$data['varPhoneContest'] = $this->request->getString('varPhoneContest', 'NotEmpty');
		$data['varInfoContest'] = $this->request->getString('varInfoContest', 'NotEmpty');
		
		if (!$this->request->getErrors()) {
			/*
			$msg = new MailMessage();
			$msg->setFrom($data['varEmailContest']);
			$msg->renderBodyFromTemplate('new_contest.eml', $data);
			new SendMailMessage(PROJECT_TO_MAIL, $msg);
			*/
			$smarty = new Smarty();
			$smarty->template_dir = TEMPLATES_PATH.'mail/';
			$smarty->compile_dir = PROJECT_CACHE.'smarty/';
			$smarty->config_dir = TEMPLATES_PATH.'mail/';
			$smarty->cache_dir = PROJECT_CACHE.'smarty/';
			$smarty->caching = (int)ENABLE_TEMPLATES_CACHE;
			$smarty->cache_lifetime = 1;
			$smarty->debugging = ENABLE_INTERNAL_DEBUG;
			$smarty->assign('data', $data);
				
			@mail(	PROJECT_TO_MAIL, 
					'Собщение обратной связи',
					$smarty->fetch('new_contest.eml'), 
					'Content-Type: text/html; charset="utf-8"' );
			
			$this->response->redirect('/');
		} else {
			$this->document->addValue('contestFlag', 'true');
			$this->document->addValue('contestData', $data);
		}
		
	} 
	
	public function OnContest() {//unset($_SESSION['question']);die;
		$questions = $this->request->Value('q');
		$intContestID = $this->request->getNumber('intContestID');
		$arr = array();
		foreach ($questions as $key => $value) {
			$arr[] = array('question' => $key, 'answer' => $value);
		}
		$tmp = $this->session->Get('question'.$intContestID);
		$keys = array();
		if(is_array($tmp) && count($tmp) > 0) {
			foreach ($tmp as $key => $value) {
				$keys[] = $value['question'];
				foreach ($arr as $k => $val) {
					if ($value['question'] == $val['question']) {
						$tmp[$key]['answer'] = $val['answer'];
					}
				}
			}
			foreach ($arr as $key => $value) {
				if (!in_array($value['question'], $keys)) {
					$tmp[] = array('question' => $value['question'], 'answer' => $value['answer']);
				}
			}
			$this->session->Set('question'.$intContestID, $tmp);
		} else {
			$this->session->Set('question'.$intContestID, $arr);
		}	
		$this->document->addValue('contestResults', $this->session->Get('question'.$intContestID));
		
		$questionsRequest = $this->session->Get('question'.$intContestID);
		$questionsOrig = $this->questionsTable->GetList(array('intContestID' => $intContestID));
		foreach ($questionsOrig as $key => $value) {
			$questionsOrig[$key]['answers'] = $this->answersTable->GetList(array('intQuestionID' => $value['intQuestionID']));
		}
		//$contestFlag = 'true';
		$errorQuestions = array();
		foreach ($questionsOrig as $key => $value) {
			foreach ($value['answers'] as $ke => $va) { 
				foreach ($questionsRequest as $k => $v) {
					if ($va['intAnswerID'] == $v['answer'] && $va['isRight'] == 0) {
						$contestFlag = 'false';
						$errorQuestions[] = $value['varQuestionText'];
					}
				}
			}
		}
		if(!empty($errorQuestions) && $contestFlag == 'false') $this->document->addValue('errorQuestions', $errorQuestions);
		$this->document->addValue('contestFlag', $contestFlag);
	}

	function getUserID() {
		return (int) $_SESSION['varUser'];
	}

	function getUserData() {
		if($this->isAutorizeted()) {
			return $this->session->Get('USER_DATA');
		} else {
			return false;
		}
	}


	function isAutorizeted() {
		if($this->getUserID() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function menu_tree($menuListParent, $parent, $addargs=null){
		foreach ($menuListParent as $key=>$value) {
			if($parent == $value['intParentID']){
				$value['chield'] = $this->menu_tree($menuListParent, $value['intMenuID']);
				if($addargs) $value['varModule'] = $addargs;
				$value['link'] = LinkCreator::create($value, $this->all_alias);
				$tmp[] = $value;
			}
		}
		return $tmp;
	}
	
	public function insertForm($content){
		preg_match_all("/({\s*form\s*name\s*=\s*([^}]+)\s*})/i",$content, $matches);
		foreach ($matches[2] as $key => $value) {
			$form = $this->form->CreateForm($value);
			$content = str_replace($matches[1][$key],$form,$content);
		}
		return $content;
	}
	
	function addDataCountries($type = 'resort'){
		if(!$this->curCountryID){$this->curCountryID = -1;}
		if(!$this->curResortID){$this->curResortID = -1;}
		$this->document->addValue('curCountryID', $this->curCountryID);
		$this->document->addValue('curCountry', $this->countriesTable->Get(array('intCountryID'=>$this->curCountryID)));
		$this->document->addValue('curResortID', $this->curResortID);
		$this->document->addValue('curRegionID', $this->curRegionID);
		$this->document->addValue('curMenuName', $this->curMenuName);

		$_GET['intCountryID'] = $this->curCountryID;
		
		$other_info = $this->OtherInfoTable->GetList(array('intCountryID'=>$this->curCountryID, 'isActive'=>1), array('intOrdering'=>'ASC'));
		foreach ($other_info as $value) {
			$value['varIdentifier'] = $value['intInfoID'];
			$value['varModule'] = 'other_info';
			$value['link'] = LinkCreator::create($value, $this->all_alias);
			$info_country_block[$value['intCategoryID']][]= $value;
			$category_ids[] = $value['intCategoryID'];
		}
		$category_ids = ($category_ids) ? array_unique($category_ids) : null;
		$category_ids[] = -1;
		$this->document->addValue('info_country_block', $info_country_block);
		$category = $this->CategoryInfoTable->GetList(array('INintCategoryID' => implode(',',$category_ids), 'isActive' => 'Yes'), array('intOrdering'=>'ASC'));
		$this->document->addValue('category_info', $category);
		
		$tmp = array();
		$resort_data = $this->ResortsTable->GetList(array('intCountryID' => $this->curCountryID, 'isViewInMenu' => 1, 'isActive'=>1));
		foreach ($resort_data as $key => $value) {
			$value['varIdentifier'] = $value['intResortID'];
			$value['varModule'] = 'resort';
			$value['link'] = LinkCreator::create($value, $this->all_alias);
			$tmp[] = $value;
			$resort_ids[] =  $value['intResortID'];
		}
		$menu_block = $tmp;
		$this->document->addValue('menu_block', $menu_block);
		$this->document->addValue('title_menu_block', $this->country['varName']);
		
		$tmp = array();
		if($resort_ids) {
			$region_data = $this->regionsTable->GetList(array('INintResortID' => implode(',',$resort_ids), 'isViewInMenu' => 1, 'isActive'=>1));
			foreach ($region_data as $key => $value) {
				$value['varIdentifier'] = $value['intRegionID'];
				$value['varModule'] = 'region';
				$value['link'] = LinkCreator::create($value, $this->all_alias);
				$tmp[$value['intResortID']][] = $value;
			}
			$region_data = $tmp;
			$this->document->addValue('region_data', $region_data);
		}
		
		$tmp = array();
		$all_relation = $this->StaffsRelationCoutrysTable->GetList(array('intCountry' => $this->curCountryID));
		$arr_staff_id[] = '-1';
		foreach ($all_relation as $value) {
			$arr_staff_id[] = $value['intStaffID'];
		}
		$arr_staff_id = array_unique($arr_staff_id);
		//$arr_staff_id = array_slice($arr_staff_id, 0 ,5);
		$staffs = $this->StaffsTable->GetList(array('INintStaffID'=>"'".implode("','",$arr_staff_id)."'", 'varView'=>'yes'));	
		$this->document->addValue('staffs_list', $staffs);
		
		$all_contact = $this->StaffsContactTable->GetList(array('INintStaffID'=>"'".implode("','",$arr_staff_id)."'"));
		foreach ($all_contact as $value) {
			$contacts_group[$value['intStaffID']][] = $value;
		}
		$tmp = array();
		foreach ($staffs as $value) {
			$value['contact'] = $contacts_group[$value['intStaffID']];
			$tmp[] = $value;
		}
		$managers = $tmp;
		$this->document->addValue('managers', $managers);
		$this->document->addValue('path', FOTO_STAFFS_URL);			
		
		$tmp = array();
		if($type=="resort"){
			$catalog_menu = $this->CatalogMenuTable->GetList(array('intParentID' => $this->curResortID, 'varParentType'=>'resort', 'isVisible'=>1), array('intSortOrder'=>'ASC'));
			foreach ($catalog_menu as $key => $value) {
		 		$value['varIdentifier2'] = $this->curResortID;
		 		$value['intResortID'] = $this->curResortID;
		 		$value['intCountryID'] = $this->curCountryID;
				$value['varParent'] = 'resort';
				$value['link'] = LinkCreator::create($value, $this->all_alias);	
				$tmp[] = $value;
			}
		}else{
			$catalog_menu = $this->CatalogMenuTable->GetList(array('intParentID' => $this->curCountryID, 'varParentType'=>'country', 'isVisible'=>1), array('intSortOrder'=>'ASC'));
			foreach ($catalog_menu as $key => $value) {
		 		$value['varIdentifier2'] = $this->curCountryID;
		 		$value['intCountryID'] = $this->curCountryID;
				$value['varParent'] = 'country';
				$value['link'] = LinkCreator::create($value, $this->all_alias);	
				$tmp[] = $value;
			}
		}
		
		$catalog_menu = $this->createTree($tmp);
		$this->document->addValue('catalog_menu', $catalog_menu);
		

	}

	function createTree($array) {
		foreach ($array as $key => $value) {
			$arr[$value['intMenuParentID']][] = $value;
		}
		return $arr;
	}

	function OnSubscribes() {

		$data['varEmail'] =	$this->request->getString('varEmail', 'Email');
		$data['varName'] = $this->request->getString('varName');
		$data['varPhone'] = $this->request->getString('varPhone');
		$data['varCountry'] = $this->request->getString('varCountry');
		$data['varCompany'] = $this->request->getString('varCompany');
		$data['varPost'] = $this->request->getString('varPost');
		$data['varDateAdd'] = date('Y-m-d H:i:s');


		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			$this->subscribesTable->Insert($data);
			$this->addMessage('Вы добавлены в список подписчиков');
			$this->response->redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function OnUnsubscribes() {

		$data['varEmail'] =	$this->request->getString('varEmail', 'Email');
		$data['varName'] = $this->request->getString('varName', 'NotEmpty');

		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			$subs = $this->subscribesTable->GetByFields($data);
			if(empty($subs)){
				$this->undata = $data;
				$this->addErrorMessage('Введите верные данные для отписки от рассылки');
			}else{
				$this->addMessage('Вы отписались от рассылки');
				$this->subscribesTable->Delete($subs);
				$this->response->redirect('/');
			}

		}
	}

	
	function render() {
		if($this->curCountryID) {
			$this->document->addValue('curCountryID', $this->curCountryID);
			$this->document->addValue('curCountry', $this->countriesTable->Get(array('intCountryID'=>$this->curCountryID)));
			$this->document->addValue('curResortID', $this->curResortID);
			$this->document->addValue('curRegionID', $this->curRegionID);
			$this->document->addValue('curMenuName', $this->curMenuName);
		}
		
		$this->document->addValue('WELCOME_TO_UKRAINE_MENU_ID', WELCOME_TO_UKRAINE_MENU_ID);
		$this->document->addValue('FILES_BG_URL', FILES_BG_URL);
        $SPOpref = $this->spoPreferencesTable->Get(array('intSPOPrefID' => 1));
        $this->document->addValue('spoPref', $SPOpref);    
		// render messages
		$this->writeMessages();

		$this->document->addValue('hilightFormElements', $this->request->getErrors());
		
		$this->document->addValue('PROJECT_URL', PROJECT_URL);
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('REQUEST_URI', $_SERVER['REQUEST_URI']);
		$this->document->addValue('tourtypes', $this->tourtypesTable->GetList());

		// валюты 

		$currency = $this->currenciesTable->getlist();
		$this->document->addValue('currency', $currency);
		// выбранный пункт меню
		$this->curMenuID = $this->request->getNumber('intMenuID');

		$this->document->addValue('generalgallery', $this->generalgalleryTable->GetList(array('intPublish'=>1), array('intOrder'=>'ASC')));
		
		// меню верхнего уровня
		if(empty($this->curMenuID)) {
			$data['intParentID'] = 0;
			$data['isVisible'] = 1;
			if(!$this->isAuthorizated) $data['isAuthorized'] = $this->isAuthorizated;
			$menuFirstLevel = $this->menuTable->GetList($data, array('intSortOrder' => 'ASC'));
			if(is_array($menuFirstLevel)) $this->curMenuID = $menuFirstLevel[0]['intMenuID'];
		}
		
		// боковое меню
		$tmp = $this->menuTable->Get(array('intMenuID' => $this->curMenuID));
		if($tmp['intParentID'] != 0) { 
			$temp = $this->menuTable->Get(array('intMenuID' => $tmp['intParentID'],'isVisible'=>1));
			if ($temp['intParentID'] == WELCOME_TO_UKRAINE_MENU_ID) {
				$tmp['intParentID'] = WELCOME_TO_UKRAINE_MENU_ID; 
				$this->curMenuID = $temp['intMenuID'];
			}
			$this->document->addValue('parentMenuID', $tmp['intParentID']);
			$this->document->addValue('childHighlight', 'true');
			
			if (!$this->isAuthorizated) {
				$this->document->addValue('menuListChilds', $this->menuTable->GetList(array('intParentID' => $tmp['intParentID'], 'isVisible'=>1, 'isAuthorized' => $this->isAuthorizated)));
			} else {
				$this->document->addValue('menuListChilds', $this->menuTable->GetList(array('intParentID' => $tmp['intParentID'], 'isVisible'=>1)));
			}
			
		} else {
			if (!$this->isAuthorizated) {
				$this->document->addValue('menuListChilds', $this->menuTable->GetList(array('intParentID' => $this->curMenuID, 'isVisible'=>1, 'isAuthorized' => $this->isAuthorizated)));
			} else {
				$this->document->addValue('menuListChilds', $this->menuTable->GetList(array('intParentID' => $this->curMenuID, 'isVisible'=>1)));
			}
			
		}
		$this->document->addValue('curMenuID', $this->curMenuID);
		
		// главное меню
		if (!$this->isAuthorizated) {
			$menuListParent = $this->menuTable->GetList(array('varTypeMenu'=>'top', 'isVisible'=>1, 'isAuthorized' => $this->isAuthorizated), array('intParentID'=>'ASC','intSortOrder' => 'ASC'));
		} else {
			$menuListParent = $this->menuTable->GetList(array('varTypeMenu'=>'top', 'isVisible'=>1), array('intParentID'=>'ASC','intSortOrder' => 'ASC'));
		}
		
		$menuListParent = $this->menu_tree($menuListParent,0);

		$this->document->addValue('menuListParent', $menuListParent);
		
		// главное меню
		if (!$this->isAuthorizated) {
			$menuListParentBottom = $this->menuTable->GetList(array('varTypeMenu'=>'bottom', 'isVisible'=>1, 'isAuthorized' => $this->isAuthorizated), array('intParentID'=>'ASC','intSortOrder' => 'ASC'));
		} else {
			$menuListParentBottom = $this->menuTable->GetList(array('varTypeMenu'=>'bottom', 'isVisible'=>1), array('intParentID'=>'ASC','intSortOrder' => 'ASC'));
		}
		
		$menuListParentBottom = $this->menu_tree($menuListParentBottom,0);

		$this->document->addValue('menuListParentBottom', $menuListParentBottom);
		
		
		$this->document->addValue('menuList', $this->menuTable->GetList(null, array('intSortOrder' => 'ASC')));
		
		// баннеры справа
		$bannersRight = $this->bannersRightTable->GetList(array('isShowBanner' => 1), array('intSortOrder' => 'ASC'));
		$this->document->addValue('bannersRight', $bannersRight);
		
		// новости
		$settings = $this->settingsTable->Get(array('intSettingsID' => 1));
		$news = $this->newsTable->GetList(array(
                        'TOvarDate' => date('Y-m-d H:i:s'), 
                        'intActive' => 1, 
                        'intOnlyAuthorized' => 0
                    ), array(
                        'varDate' => 'DESC'
                    ), 
                    null, null, null, true, null, 5
                );
		unset($news['pager']);
		$tmp = array();
		foreach ($news as $key => $value) {
			$value['varModule'] = 'news';
			$value['varIdentifier'] = $value['intNewsID'];
			$value['link'] = LinkCreator::create($value, $this->all_alias);
			$tmp[$key] = $value;
		}
		$news= $tmp;
		$this->document->addValue('news', $news);
		
		// SEO
		$this->document->addValue('metaDescription', $this->metaDescription);
		$this->document->addValue('metaKeywords', $this->metaKeywords);
		
		
		$AdvCountries = $this->AdvCountriesTable->GetList();
		$tmp = array();
		foreach ($AdvCountries as $key => $value) {
			$tmp[$value['intParentCountry']] = $value;
		}
		$AdvCountries = $tmp;
		
		// меню стран (левый блок)
		if (!$this->isAuthorizated) {
			$menuCountries = $this->menuCountriesTable->GetList(array('isVisible' => 1, 'isAuthorized' => $this->isAuthorizated), array('intSortOrder' => 'ASC'));
		} else {
			$menuCountries = $this->menuCountriesTable->GetList(array('isVisible' => 1), array('intSortOrder' => 'ASC'));
		}
		$tmp = array();
		foreach ($menuCountries as $key => $value) {
			$menuCountries[$key]['varFlag'] = $AdvCountries[$value['intCountryID']]['varImageFlag'];
		}

		$menuCountries = $this->menu_tree($menuCountries,0);
		$this->document->addValue('menuCountries', $menuCountries);

		$this->document->addValue('auth', $this->isAuthorizated);

		$ccountires = $this->countriesTable->GetList();
		foreach ($ccountires as $value) {
			$value['varModule'] = 'countries';
			$value['link'] = LinkCreator::create($value, $this->all_alias);
			$value['varModule'] = 'hotels';
			$value['hotels'] = LinkCreator::create($value, $this->all_alias);
			$value['varModule'] = 'regions';
			$value['regions'] = LinkCreator::create($value, $this->all_alias);
			$value['varModule'] = 'tours';
			$value['tours'] = LinkCreator::create($value, $this->all_alias);
			$value['varModule'] = 'vizas';
			$value['vizas'] = LinkCreator::create($value, $this->all_alias);
			$countrtmp[] = $value;
		}
		$this->document->addValue('countries', $countrtmp);
		
		// вывод подменю в меню стран в левом блоке: в столбик или в строку
		$this->document->addValue('countiesLeftBlockFlag', $this->countiesLeftBlockFlag);
		
		// хлебные крошки
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);
		
		// фотогалереи, банерные зоны, конкурсы, комментарии
		$bannersZones = array();
		$bannersToModules = array();
		$fileName = basename($_SERVER['SCRIPT_NAME'], '.php');
		$varUrlAlias = $this->request->getString('varUrlAlias');
		$thisHotel = false;
		switch($fileName) {
			case 'pages'	: 	{
					$intPageID = $this->request->getNumber('intPageID');
					if(empty($intPageID)) {
						$intPageID = LinkCreator::url_to_id('pages',$varUrlAlias,$this->all_alias);
					}
					$pagesData = $this->pagesTable->Get(array('intPageID' => $intPageID));
					$this->document->addValue('isShowComments', $pagesData['varShowComments']);
					if (!empty($intPageID)) {
						$gallIDs = $this->galleriesToModulesTable->GetByFields(array('varModuleName' => 'pages', 'intModuleID' => $intPageID), null, false);
						$bannersToModules = $this->bannersToModulesTable->GetList(array('varModuleName' => 'pages', 'intModuleID' => $intPageID));
						$comments = $this->commentsTable->GetByFields(array('varModuleName' => 'pages', 'intModuleID' => $intPageID, 'isActive' => 1), array('varDate' => 'DESC'), false);
					}
					if(!empty($pagesData['intContestID'])) $contest = $this->contestsTable->Get(array('intContestID' => $pagesData['intContestID']));
				break;
			}
			case 'news'		:	{
					$intNewsID = $this->request->getNumber('intNewsID');
					$newsData = $this->newsTable->Get(array('intNewsID' => $intNewsID));
					$this->document->addValue('isShowComments', $newsData['varShowComments']);
					if (!empty($intNewsID)) {
						$gallIDs = $this->galleriesToModulesTable->GetByFields(array('varModuleName' => 'news', 'intModuleID' => $intNewsID), null, false);
						$bannersToModules = $this->bannersToModulesTable->GetList(array('varModuleName' => 'news', 'intModuleID' => $intNewsID));
						$comments = $this->commentsTable->GetByFields(array('varModuleName' => 'news', 'intModuleID' => $intNewsID, 'isActive' => 1), array('varDate' => 'DESC'), false);
					}
					if(!empty($newsData['intContestID'])) $contest = $this->contestsTable->Get(array('intContestID' => $newsData['intContestID']));	
				break;
			}
			
			case 'adv_country'		:	{
					$intCountryID = $this->request->getNumber('intCountryID');
					if(empty($intCountryID)) {
						$intCountryID = LinkCreator::url_to_id('AdvCountries',$varUrlAlias,$this->all_alias);
					}
					$country = $this->AdvCountriesTable->Get(array('intCountryID' => $intCountryID));
					$this->document->addValue('isShowComments', $country['varShowComments']);
					$gallIDs = $this->galleriesToModulesTable->GetByFields(array('varModuleName' => 'adv_country', 'intModuleID' => $intCountryID), null, false);
					$bannersToModules = $this->bannersToModulesTable->GetList(array('varModuleName' => 'adv_country', 'intModuleID' => $intCountryID));
					$comments = $this->commentsTable->GetByFields(array('varModuleName' => 'adv_country', 'intModuleID' => $intCountryID, 'isActive' => 1), array('varDate' => 'DESC'), false);	
				break;
			}
			case 'adv_resort'		:	{
					$intResortID = $this->request->getNumber('intResortID');
					if(empty($intResortID)) {
						$intResortID = LinkCreator::url_to_id('AdvResorts',$varUrlAlias,$this->all_alias);
					}
					$resorts = $this->AdvResortsTable->Get(array('intResortID' => $intResortID));
					$this->document->addValue('isShowComments', $resorts['varShowComments']);
					$gallIDs = $this->galleriesToModulesTable->GetByFields(array('varModuleName' => 'adv_resorts', 'intModuleID' => $intResortID), null, false);
					$bannersToModules = $this->bannersToModulesTable->GetList(array('varModuleName' => 'adv_resorts', 'intModuleID' => $intResortID));
					$comments = $this->commentsTable->GetByFields(array('varModuleName' => 'adv_resorts', 'intModuleID' => $intResortID, 'isActive' => 1), array('varDate' => 'DESC'), false);	
				break;
			}
			case 'adv_resort_content'		:	{
					$intResortContentID = $this->request->getNumber('intResortContentID');
					if(empty($intResortContentID)) {
						$intResortContentID = LinkCreator::url_to_id('AdvResortsContent',$varUrlAlias,$this->all_alias);
					}
					$resorts = $this->AdvResortsContentTable->Get(array('intResortContentID' => $intResortContentID));
					$this->document->addValue('isShowComments', $resorts['varShowComments']);
					$gallIDs = $this->galleriesToModulesTable->GetByFields(array('varModuleName' => 'adv_resorts_content', 'intModuleID' => $intResortContentID), null, false);
					$bannersToModules = $this->bannersToModulesTable->GetList(array('varModuleName' => 'adv_resorts_content', 'intModuleID' => $intResortContentID));
					$comments = $this->commentsTable->GetByFields(array('varModuleName' => 'adv_resorts_content', 'intModuleID' => $intResortContentID, 'isActive' => 1), array('varDate' => 'DESC'), false);	
				break;
			}
			
			case 'country'		:	{
					$intCountryID = $this->request->getNumber('intCountryID') ? $this->request->getNumber('intCountryID') : $this->curCountryID;
					if(empty($intCountryID)) {
						$intCountryID = LinkCreator::url_to_id('countries',$varUrlAlias,$this->all_alias);
					}
					$country = $this->countriesTable->Get(array('intCountryID' => $intCountryID));
					$this->document->addValue('isShowComments', $country['varShowComments']);
					$gallIDs = $this->galleriesToModulesTable->GetByFields(array('varModuleName' => 'countries', 'intModuleID' => $intCountryID), null, false);
					$bannersToModules = $this->bannersToModulesTable->GetList(array('varModuleName' => 'countries', 'intModuleID' => $intCountryID));
					$comments = $this->commentsTable->GetByFields(array('varModuleName' => 'countries', 'intModuleID' => $intCountryID, 'isActive' => 1), array('varDate' => 'DESC'), false);	
				break;
			}
			
			case 'resort'		:	{
					$intResortID = $this->request->getNumber('intResortID');
					if(empty($intResortID)) {
						$intResortID = LinkCreator::url_to_id('resorts',$varUrlAlias,$this->all_alias);					
					}
					$resorts = $this->ResortsTable->Get(array('intResortID' => $intResortID));
					$this->document->addValue('isShowComments', $resorts['varShowComments']);
					$gallIDs = $this->galleriesToModulesTable->GetByFields(array('varModuleName' => 'resorts', 'intModuleID' => $intResortID), null, false);
					$bannersToModules = $this->bannersToModulesTable->GetList(array('varModuleName' => 'resorts', 'intModuleID' => $intResortID));
					$comments = $this->commentsTable->GetByFields(array('varModuleName' => 'resorts', 'intModuleID' => $intResortID, 'isActive' => 1), array('varDate' => 'DESC'), false);	
				break;
			}
			
			case 'region'		:	{
					$intRegionID = $this->request->getNumber('intRegionID');
					if(empty($intRegionID)) {
						$intRegionID = LinkCreator::url_to_id('regions',$varUrlAlias,$this->all_alias);
					}
					$region = $this->regionsTable->Get(array('intRegionID' => $intRegionID));
					$this->document->addValue('isShowComments', $region['varShowComments']);
					$gallIDs = $this->galleriesToModulesTable->GetByFields(array('varModuleName' => 'regions', 'intModuleID' => $intRegionID), null, false);
					$bannersToModules = $this->bannersToModulesTable->GetList(array('varModuleName' => 'regions', 'intModuleID' => $intResortID));
					$comments = $this->commentsTable->GetByFields(array('varModuleName' => 'regions', 'intModuleID' => $intResortID, 'isActive' => 1), array('varDate' => 'DESC'), false);	
				break;
			}
			case 'hotel'		:	{
					$intHotelID = $this->intHotelID;
					if(empty($intHotelID)) {
						$intHotelID = LinkCreator::url_to_id('hotels',$varUrlAlias,$this->all_alias);
					}
					$hotel = $this->hotelsTable->Get(array('intHotelID' => $intHotelID));
					$this->document->addValue('isShowComments', $hotel['varShowComments']);
					$gallIDs = $this->galleriesToModulesTable->GetList(array(/*'varModuleName' => 'hotels',*/ 'intModuleID' => $intHotelID), null, false);
					$dat['varModule'] = 'hotel_gallery';
					$dat['varIdentifier'] = $intHotelID;
					$gallery_link = LinkCreator::create($dat,$this->all_alias);
					$this->document->addValue('gallery_link', $gallery_link);
					$limit = 4;
					$thisHotel = true;
					$bannersToModules = $this->bannersToModulesTable->GetList(array('varModuleName' => 'hotels', 'intModuleID' => $intHotelID));
					$comments = $this->commentsTable->GetByFields(array('varModuleName' => 'hotels', 'intModuleID' => $intHotelID, 'isActive' => 1), array('varDate' => 'DESC'), false);	
				break;
			}
			case 'hotel_gallery'		:	{
					$intHotelID = $this->intHotelID;
					$hotel = $this->hotelsTable->Get(array('intHotelID' => $intHotelID));
					$this->document->addValue('isShowComments', $hotel['varShowComments']);
					$gallIDs = $this->galleriesToModulesTable->GetByFields(array(/*'varModuleName' => 'hotels', */'intModuleID' => $intHotelID), null, false);
					$dat['varModule'] = 'hotel_gallery';
					$dat['varIdentifier'] = $intHotelID;
					$gallery_link = LinkCreator::create($dat,$this->all_alias);
					$this->document->addValue('gallery_link', $gallery_link);
					$bannersToModules = $this->bannersToModulesTable->GetList(array('varModuleName' => 'hotels', 'intModuleID' => $intHotelID));
					$comments = $this->commentsTable->GetByFields(array('varModuleName' => 'hotels', 'intModuleID' => $intHotelID, 'isActive' => 1), array('varDate' => 'DESC'), false);	
				break;
			}
			
			case 'attraction'		:	{
					$intAttractionID = $this->request->getNumber('intAttractionID');
					if(empty($intAttractionID)) {
						$intAttractionID = LinkCreator::url_to_id('attractions',$varUrlAlias,$this->all_alias);
					}
					$attraction = $this->regionsTable->Get(array('intAttractionID' => $intAttractionID));
					$this->document->addValue('isShowComments', false);
					$gallIDs = $this->galleriesToModulesTable->GetByFields(array('varModuleName' => 'attractions', 'intModuleID' => $intAttractionID), null, false);
					$bannersToModules = $this->bannersToModulesTable->GetList(array('varModuleName' => 'attractions', 'intModuleID' => $intAttractionID));
				break;
			}
			case 'excursion'		:	{
					$intExcursionID = $this->request->getNumber('intExcursionID');
					$excursion = $this->regionsTable->Get(array('intExcursionID' => $intExcursionID));
					$this->document->addValue('isShowComments', false);
					$gallIDs = $this->galleriesToModulesTable->GetByFields(array('varModuleName' => 'excursions', 'intModuleID' => $intExcursionID), null, false);
					$bannersToModules = $this->bannersToModulesTable->GetList(array('varModuleName' => 'excursions', 'intModuleID' => $intExcursionID));
				break;
			}
			
			default	: {
					$modPageData = $this->modulesPagesTable->GetByFields(array('varPage' => $fileName));
					$this->document->addValue('isShowComments', $modPageData['varShowComments']);
					if (!empty($modPageData)) {
						$gallIDs = $this->galleriesToModulesTable->GetByFields(array('varModuleName' => $modPageData['varPage'], 'intModuleID' => $modPageData['intModulePageID']), null, false);
						$bannersToModules = $this->bannersToModulesTable->GetList(array('varModuleName' => $modPageData['varPage'], 'intModuleID' => $modPageData['intModulePageID']));
						$comments = $this->commentsTable->GetByFields(array('varModuleName' => $modPageData['varPage'], 'intModuleID' => $modPageData['intModulePageID'], 'isActive' => 1), array('varDate' => 'DESC'), false);			
					}
					if(!empty($modPageData['intContestID'])) $contest = $this->contestsTable->Get(array('intContestID' => $modPageData['intContestID']));
				break;
			}	
		}
		if (!empty($gallIDs)) {
			$tmp = array('-1');
			foreach ($gallIDs as $key => $value) $tmp[] = $value['intGalleryID']; 
			$galleries = $this->gallerysTable->getGalleriesForCurModule("'".implode("','", $tmp)."'");
			$images = $this->imagesTable->getImagesForCurModule("'".implode("','", $tmp)."'", $fileName);
			$c = 1;
			$tmp = array();
			foreach ($images as $k => $image) {
				$image['imageUrl'] = $this->getImageUrl($image['varFileName'], '260x192', 'obs');
				$image['imageOrigUrl'] = $this->getImageUrl($image['varFileName'], null , 'obs');
				$image['varTitle'] = htmlentities($images[$k]['varTitle'], ENT_QUOTES, 'UTF-8');
				$tmp[$image['intGalleryID']][] = $image;
				if($limit && $limit < $c){
					break;
				}
				$c++;
			}
			$images = $tmp;
			$this->document->addValue('galleries', $galleries);
			$this->document->addValue('gallsImages', $images);
		}
		
		$this->document->addValue('thisHotel', $thisHotel);
		$this->document->addValue('REQUEST_URI', $_SERVER['REQUEST_URI']);

		
		if (!empty($bannersToModules)) {
			foreach ($bannersToModules as $key => $value) {
				$bannersZones[] = $this->bannersMainTable->Get(array('intBannerZoneID' => $value['intBannerZoneID']));
			}
			if (count($bannersZones) > 0) {
				$bannersZone = $bannersZones[rand(0, count($bannersZones) - 1)];
			}
			$this->document->addValue('bannersZone', $bannersZone);
		} else {
			$bannersZone = $this->bannersMainTable->GetByFields(array('isDefault' => 1));
		}
		if (!empty($bannersZone)) $this->document->addValue('bannersZone', $bannersZone);
		if (!empty($comments)) $this->document->addValue('comments', $comments);
		if (!empty($contest)) {
			$this->contestPage = $this->request->getNumber('page', null, 1);
			$questions = $this->questionsTable->GetList(array('intContestID' => $contest['intContestID']), null, null, null, null, true, $this->contestPage, $contest['intCountQuestionsInPage']);
			foreach ($questions as $key => $value) {
				if (is_int($key)) {
					$questions[$key]['answers'] = $this->answersTable->GetList(array('intQuestionID' => $value['intQuestionID']));
				}
			}
			$contest['curQuestionIndex'] = $this->request->getNumber('curQuestionIndex', null, 1);
			$contest['questions'] = $questions;
			$this->document->addValue('contest', $contest);
			$this->document->addValue('lastQuestionID', (count($questions) > 0) ? $questions[count($questions) - 1]['intQuestionID'] : 0);
			//$questions = $this->questionsTable->GetList(array('intContestID' => $contest['intContestID']));
		}

		$this->document->addValue('gcurrency', $this->currenciesTable->Get(array('intCurrencyID'=>1)));
		
		// bottom links
		$links = $this->bottomLinksTable->GetList(null, array('intSortOrder' => 'ASC'));
		$this->document->addValue('bottom_links', $links);
		$static_zone = $this->StaticZoneTable->GetList(array('isActive'=>1), array('intOrdering'=>'DESC'));
		foreach ($static_zone as $value){
			$tmp[$value['varPosition']][] = $value;
		}
		$static_zone = $tmp;
		$this->document->addValue('static_zone', $static_zone);
		$this->document->addValue('resorts', $this->ResortsTable->GetList());

		$this->document->addValue('fast_search', true);
		$tmp = array();
		$hotel = $this->hotelsTable->getListIDsNamesSite();
		foreach ($hotel as $key => $value) {
			$val['varModule'] = 'hotel'; 
			$val['varIdentifier'] = $value['intHotelID'];
			$url = LinkCreator::create($val, $this->all_alias);
			$tmp[] = array('text'=>$value['varName'], 'url'=>$url);
			
		}
		$hotel = $tmp;
		//

		if($_SESSION['USER_DATA'] && $_SESSION['USER_DATA']['intUserID']) {
			$this->document->addValue('UserData', $_SESSION['USER_DATA']);
		}
		
		$roles = $this->tourtypesTable->getList(array('intActive' => 1), array('varName' => 'ASC'));
		$this->document->addValue('tourtypes', $roles);
		
		$this->document->addValue('leftlinks', $this->LinksTable->GetList(array('intActive' => 1)));
		$this->document->addValue('bannerpath', IMG_BANNER_ZONE_URL);
		$this->document->addValue('IMAGES_URL', IMAGES_URL);
		$this->document->addValue( 'URL', $this->getCurPageURL() );

		$this->document->addValue('json_hotel', json_encode($hotel));
		
	}
	
}
