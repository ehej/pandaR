<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.OtherInfoTable");
Kernel::Import("classes.data.CategoryInfoTable");
Kernel::Import("classes.data.GallerysTable");
Kernel::Import("classes.data.GalleriesToModulesTable");
Kernel::Import("classes.data.BannersMainTable");
Kernel::Import("classes.data.BannersToModulesTable");

class IndexPage extends AdminPage {

	public $CountriesTable;
	public $ResortsTable;
	public $OtherInfoTable;
	public $gallerysTable;
	public $galleriesToModulesTable;
	public $bannersToModulesTable;
	public $bannersMainTable;
	public $CategoryInfoTable;
	
	var $data = false;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование информации о достопримечательности');
		$this->setBoldMenu('other_info');		
		
		$this->CountriesTable = new CountriesTable($this->connection);
		$this->ResortsTable = new ResortsTable($this->connection);
		$this->OtherInfoTable = new OtherInfoTable($this->connection);
		$this->gallerysTable = new GallerysTable($this->connection);
		$this->galleriesToModulesTable = new GalleriesToModulesTable($this->connection);
		$this->bannersToModulesTable = new BannersToModulesTable($this->connection);
		$this->bannersMainTable = new BannersMainTable($this->connection);
		$this->CategoryInfoTable= new CategoryInfoTable($this->connection);	
		
		$intInfoID = $this->request->getNumber('intInfoID', 0);
		if ($intInfoID) {
			$this->data = $this->OtherInfoTable->Get(array('intInfoID' => $intInfoID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет достопримечательности с заданным ID');
				$this->response->redirect('other_info.php');
			}
		}
	}

 	function OnSave() {
		$data['intInfoID'] 				= $this->request->getNumber('intInfoID');
		$data['intCountryID'] 			= $this->request->getNumber('intCountryID', 'NotEmpty');
		$data['intCategoryID'] 			= $this->request->getNumber('intCategoryID', 'NotEmpty');
		$data['varName'] 				= $this->request->getString('varName', 'NotEmpty');
		$data['varUrlAlias'] 			= $this->request->getString('varUrlAlias', 'NotEmpty');
		$data['varPageTitle'] 			= $this->request->getString('varPageTitle');
		$data['varPageKeywords']		= $this->request->getString('varPageKeywords');
		$data['varPageDescription'] 	= $this->request->getString('varPageDescription');
		$data['varH1Text'] 				= $this->request->getString('varH1Text');
		$data['varContent'] 			= $this->request->getString('varContent', 'NotEmpty');
		$data['intOrdering'] 			= $this->request->getNumber('intOrdering');
		$data['isActive'] 				= $this->request->getNumber('isActive');
		
		$intGalleryIDList = $this->request->Value('intGalleryID');
		$intBannersMainIDList = $this->request->Value('intBannerZoneID');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			

			if (isset($data['intInfoID']) && !empty($data['intInfoID'])) {
				$this->OtherInfoTable->Update($data);
			} else {
				$this->OtherInfoTable->Insert($data);
			}

			$intInfoID = $data['intInfoID'];
			$arrTmp = array('varModuleName' => 'other_info', 'intModuleID' => $intInfoID);
			$this->galleriesToModulesTable->DeleteByFields($arrTmp);	
			foreach($intGalleryIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'other_info';
				$d['intModuleID'] = $data['intInfoID'];
				$d['intGalleryID'] = $value;
				$this->galleriesToModulesTable->Insert($d);
			}
			$intInfoID = $data['intInfoID'];
			$arrTmp = array('varModuleName' => 'other_info', 'intModuleID' => $intInfoID);
			$this->bannersToModulesTable->DeleteByFields($arrTmp);	
			foreach($intBannersMainIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'other_info';
				$d['intModuleID'] = $data['intInfoID'];
				$d['intBannerZoneID'] = $value;
				$this->bannersToModulesTable->Insert($d);
			}
			
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intInfoID']) && !empty($data['intInfoID'])) $this->response->redirect('other_info.edit.php?intInfoID='.$data['intInfoID']);
		}
	}
	
	function render() {
		parent::render();
		$this->document->addValue('data', $this->data);		
		$resorts = $this->ResortsTable->GetList(null, array('varName'=>'ASC'));
		$this->document->addValue('resorts_list', $resorts);
		$countries = $this->CountriesTable->GetList(null, array('varName'=>'ASC'));
		$this->document->addValue('countries_list', $countries);
		$category = $this->CategoryInfoTable->GetList(null, array('varName'=>'ASC'));
		$this->document->addValue('category_list', $category);
		
		$this->document->addValue('banners_main_list', $this->bannersMainTable->GetList());
        $this->document->addValue('galeries_list', $this->gallerysTable->GetList());
        if($this->data['intInfoID']!='') {
		    $this->document->addValue('banners_to_modules', $this->bannersToModulesTable->GetList(array('varModuleName' => 'other_info', 'intModuleID' => $this->data['intInfoID'])));
		    $this->document->addValue('galleries_to_modules', $this->galleriesToModulesTable->GetList(array('varModuleName' => 'other_info', 'intModuleID' => $this->data['intInfoID'])));
        }
	}

}

Kernel::ProcessPage(new IndexPage("other_info.edit.tpl"));