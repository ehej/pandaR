<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.MenuCountriesTable");
Kernel::Import("classes.data.GallerysTable");
Kernel::Import("classes.data.GalleriesToModulesTable");
Kernel::Import("classes.data.BannersMainTable");
Kernel::Import("classes.data.BannersToModulesTable");
Kernel::Import("classes.data.TblCountryTable");
Kernel::Import("classes.data.PagesToCountriesTable");
Kernel::Import("classes.data.PagesTable");

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
	 * @var BannersToModulesTable
	 */
	var $bannersToModulesTable;
	/**
	 * @var BannersMainTable
	 */
	var $bannersMainTable;
	/**
	 * @var TblCountryTable
	 */
	var $tblCountryTable;
	/**
	 * @var PagesToCountriesTable
	 */
	var $pagesToCountriesTable;
	/**
	 * @var PagesTable
	 */
	var $pagesTable;
	
	var $data = false;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных страны');
		$this->setBoldMenu('countriesCatalog');		
		
		$this->countriesTable = new CountriesTable($this->connection);
		$this->menuCountriesTable = new MenuCountriesTable($this->connection);
		$this->gallerysTable = new GallerysTable($this->connection);
		$this->galleriesToModulesTable = new GalleriesToModulesTable($this->connection);
		$this->bannersToModulesTable = new BannersToModulesTable($this->connection);
		$this->bannersMainTable = new BannersMainTable($this->connection);
		$this->pagesToCountriesTable = new PagesToCountriesTable($this->connection);
		$this->pagesTable = new PagesTable($this->connection);
	
		$intCountryID = $this->request->getNumber('intCountryID', 0);
		if ($intCountryID) {
			$this->data = $this->countriesTable->Get(array('intCountryID' => $intCountryID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет страны с заданным ID');
				$this->response->redirect('countries_catalog.php');
			}
		}
	}

 	function OnSave() {
		$data['intCountryID'] = $this->request->getNumber('intCountryID');
		$data['varName'] =	$this->request->getString('varName', 'NotEmpty');
		$data['varTitle'] =	$this->request->getString('varName');
		$data['varUrlAlias'] = $this->request->getString('varUrlAlias', 'NotEmpty');
		$data['varMetaTitle'] = $this->request->getString('varMetaTitle');
		$data['varMetaKeywords'] = $this->request->getString('varMetaKeywords');
		$data['varMetaDescription'] = $this->request->getString('varMetaDescription');
		$data['varDescription'] = $this->request->getString('varDescription');
		$data['varDescriptionCountry'] = $this->request->getString('varDescriptionCountry');
		$data['varVisas'] = $this->request->getString('varVisas');
		$data['varEmbassies'] = $this->request->getString('varEmbassies');
		$data['varFlag'] = $this->request->getFiles('varFlag', 'NotEmpty');
		$data['varShowComments'] = $this->request->getString('varShowComments');
		$data['isShowSPO'] = $this->request->getString('isShowSPO');
		$data['intMenuID'] = $this->data['intMenuID'];
		if(!$data['varShowComments']) $data['varShowComments'] = 'no';
		$intGalleryIDList = $this->request->Value('intGalleryID');
		$intBannersMainIDList = $this->request->Value('intBannerZoneID');
		$intPagesIDList = $this->request->Value('intPageID');
		$data['intMTCountryID'] = $this->request->getNumber('intMTCountryID');
		$data['isVisible'] = $data['isActive'] = $this->request->getNumber('isActive');
		$tmpdata = $data;
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if ($data['varFlag']['size']) {
				$data['varRealFlagName'] = $data['varFlag']['name'];
				$file_path = FILES_PATH;
				if (!empty($this->data['varFlag'])) unlink($file_path.$this->data['varFlag']);
				$file_pathinfo = pathinfo($data['varFlag']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varFlag']['tmp_name'], $file_path.$file_name);
				chmod($file_path.$file_name, 0777);
				$data['varFlag'] = $file_name;
			} else $data['varFlag'] = $this->data['varFlag'];
			
			$tmpcount = $this->menuCountriesTable->GetCount(array('intParentID' => 0, 'intCountryID' => $data['intCountryID']));
			
			$tmpdata['varModule'] = 'country';
			if ($data['intCountryID']) {
				$tmpdata['intCountryID'] = $data['intCountryID'];
				if($tmpcount) {
					$this->menuCountriesTable->Update($tmpdata);
				} else {
					$this->menuCountriesTable->Insert($tmpdata);
				}
				$data['intMenuID'] = $tmpdata['intMenuID'];
				$this->countriesTable->Update($data);
			} else {
				$this->menuCountriesTable->Insert($tmpdata);
				$data['intMenuID'] = $tmpdata['intMenuID'];
				$this->countriesTable->Insert($data);
			}

			$intCountryID = $data['intCountryID'];
			$arrTmp = array('varModuleName' => 'countries', 'intModuleID' => $intCountryID);
			$this->galleriesToModulesTable->DeleteByFields($arrTmp);	
			foreach((array)$intGalleryIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'countries';
				$d['intModuleID'] = $data['intCountryID'];
				$d['intGalleryID'] = $value;
				$this->galleriesToModulesTable->Insert($d);
			}
			
			$intCountryID = $data['intCountryID'];
			$arrTmp = array('varModuleName' => 'countries', 'intModuleID' => $intCountryID);
			$this->bannersToModulesTable->DeleteByFields($arrTmp);	
			foreach((array)$intBannersMainIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'countries';
				$d['intModuleID'] = $data['intCountryID'];
				$d['intBannerZoneID'] = $value;
				$this->bannersToModulesTable->Insert($d);
			}
			
			$intCountryID = $data['intCountryID'];
			$arrTmp = array('intCountryID' => $intCountryID);
			$this->pagesToCountriesTable->DeleteByFields($arrTmp);	
			foreach($intPagesIDList as $key => $value) {
				$d = array();
				$d['intCountryID'] = $data['intCountryID'];
				$d['intPageID'] = $value;
				$this->pagesToCountriesTable->Insert($d);
			}
			
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intCountryID']) && !empty($data['intCountryID'])) $this->response->redirect('countries_catalog.edit.php?intCountryID='.$data['intCountryID']);
		}
	}

	function OnDeleteFlag() {
		$data['intCountryID'] = $this->request->getNumber('intCountryID', 'NotEmpty');
		$data['varFlag'] =	$this->request->getString('varFlag', 'NotEmpty');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки');
		} else {
			if (!empty($this->data['varFlag'])) {
				unlink(FILES_PATH.$this->data['varFlag']);
				$this->data['varFlag'] = '';
				$this->data['varRealFlagName'] = '';
				$this->countriesTable->Update($this->data);
			}
		}
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('data', $this->data);		
		$this->document->addValue('countries_list', $this->countriesTable->GetList());
		$this->document->addValue('banners_main_list', $this->bannersMainTable->GetList());

		$this->document->addValue('galeries_list', $this->gallerysTable->GetList());
        if($this->data['intCountryID']!='') {
            $this->document->addValue('banners_to_modules', $this->bannersToModulesTable->GetList(array('varModuleName' => 'countries', 'intModuleID' => $this->data['intCountryID'])));
		    $this->document->addValue('galleries_to_modules', $this->galleriesToModulesTable->GetList(array('varModuleName' => 'countries', 'intModuleID' => $this->data['intCountryID'])));
            $this->document->addValue('pages_to_countries', $this->pagesToCountriesTable->GetList(array('intCountryID' => $this->data['intCountryID'])));
        }

		$this->document->addValue('pages_list', $this->pagesTable->GetList());		
	}

}

Kernel::ProcessPage(new IndexPage("countries_catalog.edit.tpl"));