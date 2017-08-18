<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.PagesTable");
Kernel::Import("classes.data.GallerysTable");
Kernel::Import("classes.data.BannersMainTable");
Kernel::Import("classes.data.GalleriesToModulesTable");
Kernel::Import("classes.data.BannersToModulesTable");
Kernel::Import("classes.data.ContestsTable");
Kernel::Import("classes.data.countriesTable");
Kernel::Import("classes.data.pagesToCountriesTable");

class IndexPage extends AdminPage {

	/**
	 * @var PagesTable
	 */
	var $pagesTable;
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
	 * @var ContestsTable
	 */
	var $contestsTable;
	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	/**
	 * @var pagesToCountriesTable
	 */
	var $pagesToCountriesTable;
	
	var $data = false;

	function index() {
		parent::index();

		$this->setPageTitle('Редактирование данных страницы');
		$this->setBoldMenu('pages');		
		
		$this->pagesTable = new PagesTable($this->connection);
		$this->gallerysTable = new GallerysTable($this->connection);
		$this->galleriesToModulesTable = new GalleriesToModulesTable($this->connection);
		$this->bannersToModulesTable = new BannersToModulesTable($this->connection);
		$this->bannersMainTable = new BannersMainTable($this->connection);
		$this->contestsTable = new ContestsTable($this->connection);
		$this->countriesTable = new CountriesTable($this->connection);
		$this->pagesToCountriesTable = new PagesToCountriesTable($this->connection);
		
		$intPageID = $this->request->getNumber('intPageID', 0);
		if ($intPageID) {
			$this->data = $this->pagesTable->Get(array('intPageID'=>$intPageID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет страницы с заданным ID');
				$this->response->redirect('pages.php');
			}
		}
	}

 	function OnSave() {
		$data['intPageID'] = $this->request->getNumber('intPageID');
		$data['varTitle'] =	$this->request->getString('varTitle', 'NotEmpty');
		$data['varUrlAlias'] =	$this->request->getString('varUrlAlias', 'NotEmpty');
		$data['varAnnotation'] = $this->request->getString('varAnnotation');
		$data['varMetaTitle'] =	$this->request->getString('varMetaTitle');
		$data['varMetaKeywords'] = $this->request->getString('varMetaKeywords');
		$data['varMetaDescription'] = $this->request->getString('varMetaDescription');
		$data['intContestID'] = $this->request->getNumber('intContestID');
		$data['varDescription'] = $this->request->getString('varDescription');
		$data['intOnlyAuthorized'] = $this->request->getNumber('intOnlyAuthorized', 0);
		$data['intActive'] = $this->request->getNumber('intActive', 0);
		$data['ptc']['intPageToCountryID'] = $this->request->getNumber('intPageToCountryID', 0);
		$data['ptc']['intCountryID'] = $this->request->getNumber('intСountryID', 0);
		$data['ptc']['intPageID'] = $this->request->getNumber('intPageID');
		
		
		$data['varShowComments'] = $this->request->getString('varShowComments');
		if(!$data['varShowComments']) $data['varShowComments'] = 'no';
		$intGalleryIDList = $this->request->Value('intGalleryID');
		$intBannersMainIDList = $this->request->Value('intBannerZoneID');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if (isset($data['intPageID']) && !empty($data['intPageID'])) {
				$this->pagesTable->Update($data);
			} else {
				$this->pagesTable->Insert($data);
				$data['ptc']['intPageID'] = $this->pagesToCountriesTable->getInsertId();
			}
			if($data['ptc']['intCountryID'] != ''){
				if($data['ptc']['intPageToCountryID'] != ''){
					$this->pagesToCountriesTable->Update($data['ptc']);
				}else{
					$this->pagesToCountriesTable->Insert($data['ptc']);
				}
			}
			
			$intPageID = $data['intPageID'];
			$arrTmp = array('varModuleName' => 'pages', 'intModuleID' => $intPageID);
			$this->galleriesToModulesTable->DeleteByFields($arrTmp);	
			foreach($intGalleryIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'pages';
				$d['intModuleID'] = $data['intPageID'];
				$d['intGalleryID'] = $value;
				$this->galleriesToModulesTable->Insert($d);
			}
			
			$intPageID = $data['intPageID'];
			$arrTmp = array('varModuleName' => 'pages', 'intModuleID' => $intPageID);
			$this->bannersToModulesTable->DeleteByFields($arrTmp);	
			foreach($intBannersMainIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'pages';
				$d['intModuleID'] = $data['intPageID'];
				$d['intBannerZoneID'] = $value;
				$this->bannersToModulesTable->Insert($d);
			}
			
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intPageID']) && !empty($data['intPageID'])) $this->response->redirect('pages.edit.php?intPageID='.$data['intPageID']);
		}
	}

	function render() {
		parent::render();
		
		$this->document->addValue('data', $this->data);	
		if($this->data){
			$this->document->addValue('ptc', $this->pagesToCountriesTable->GetByFields(array('intPageID'=>$this->data['intPageID'])));
		}
		
		$this->document->addValue('countries', $this->countriesTable->GetList(null, array('varName'=>'ASC')));
		$this->document->addValue('contests', $this->contestsTable->GetList());	
		$this->document->addValue('galeries_list', $this->gallerysTable->GetList());
        
		$this->document->addValue('banners_main_list', $this->bannersMainTable->GetList());

        if($this->data['intPageID']!='') {
            $this->document->addValue('galleries_to_modules', $this->galleriesToModulesTable->GetList(array('varModuleName' => 'pages', 'intModuleID' => $this->data['intPageID'])));
		    $this->document->addValue('banners_to_modules', $this->bannersToModulesTable->GetList(array('varModuleName' => 'pages', 'intModuleID' => $this->data['intPageID'])));
        }
      }

}

Kernel::ProcessPage(new IndexPage("pages.edit.tpl"));
