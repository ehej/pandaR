<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.AdvCountriesTable");
Kernel::Import("classes.data.AdvResortsTable");
Kernel::Import("classes.data.AdvResortsContentTable");
Kernel::Import("classes.data.GallerysTable");
Kernel::Import("classes.data.GalleriesToModulesTable");
Kernel::Import("classes.data.BannersMainTable");
Kernel::Import("classes.data.BannersToModulesTable");

class IndexPage extends AdminPage {

	/**
	 * @var CountriesTable
	 */
	var $CountriesTable;
	/**
	 * @var AdvCountriesTable
	 */
	var $AdvCountriesTable;
	/**
	 * @var AdvResortsTable
	 */
	var $AdvResortsTable;
	/**
	 * @var AdvResortsContentTable
	 */
	var $AdvResortsContentTable;
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
	
	var $page = 1;
	
	var $data = false;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование информации о страны');
		$this->setBoldMenu('countries_catalog_adv');		
		$this->CountriesTable = new CountriesTable($this->connection);
		$this->AdvCountriesTable = new AdvCountriesTable($this->connection);
		$this->AdvResortsTable = new AdvResortsTable($this->connection);
		$this->AdvResortsContentTable = new AdvResortsContentTable($this->connection);
		$this->gallerysTable = new GallerysTable($this->connection);
		$this->galleriesToModulesTable = new GalleriesToModulesTable($this->connection);
		$this->bannersToModulesTable = new BannersToModulesTable($this->connection);
		$this->bannersMainTable = new BannersMainTable($this->connection);
			
		$intCountryID = $this->request->getNumber('intCountryID', 0);
		if ($intCountryID) {
			$this->data = $this->AdvCountriesTable->Get(array('intCountryID' => $intCountryID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет страны с заданным ID');
				//$this->response->redirect('countries_catalog_adv.php');
			}
		}
	}

 	function OnSave() {
		$data['intCountryID'] 			= $this->request->getNumber('intCountryID');
		$data['intParentCountry'] 		= $this->request->getNumber('intParentCountry');
		$data['varName'] 				= $this->request->getString('varName', 'NotEmpty');
		$data['varUrlAlias'] 			= $this->request->getString('varUrlAlias', 'NotEmpty');
		$data['varPageTitle'] 			= $this->request->getString('varPageTitle');
		$data['varPageKeywords']		= $this->request->getString('varPageKeywords');
		$data['varPageDescription'] 	= $this->request->getString('varPageDescription');
		$data['varDescription'] 		= $this->request->getString('varDescription', 'NotEmpty');
		$data['varDescription2'] 		= $this->request->getString('varDescription2');
		$data['varH1Text'] 				= $this->request->getString('varH1Text');
		$data['varImage'] 				= $this->request->getFiles ('varImage');
		$data['varImageFlag']			= $this->request->getFiles ('varImageFlag');
		$data['varImageMap'] 			= $this->request->getFiles ('varImageMap');
		$data['intOrdering'] 			= $this->request->getNumber('intOrdering');
		$data['isActive'] 				= $this->request->getNumber('isActive');
		
		$intGalleryIDList 				= $this->request->Value('intGalleryID');
		$intBannersMainIDList 			= $this->request->Value('intBannerZoneID');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			$file_path = FILES_PATH;
			if ($data['varImage']['size']) {
				if (!empty($this->data['varImage'])) unlink($file_path.$this->data['varImage']);
				$file_pathinfo = pathinfo($data['varImage']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				
				$dir = $file_path.substr($file_name, 0, 3)."/";
				if ( ! is_dir($dir)){
					if ( ! mkdir($dir, 0777)){
						echo $data['messages'][] = 'Не удалось создать директорию для загрузки файла';
					}else{
						chmod($dir, 0777);
					}
				}
				move_uploaded_file($data['varImage']['tmp_name'], $dir.$file_name);
				chmod($dir.$file_name, 0777);
				$data['varImage'] = $file_name;
			} else $data['varImage'] = $this->data['varImage'];
			
			if ($data['varImageFlag']['size']) {
				if (!empty($this->data['varImageFlag'])) unlink($file_path.$this->data['varImageFlag']);
				$file_pathinfo = pathinfo($data['varImageFlag']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				$dir = $file_path.substr($file_name, 0, 3)."/";
				if ( ! is_dir($dir)){
					if ( ! mkdir($dir, 0777)){
						echo $data['messages'][] = 'Не удалось создать директорию для загрузки файла';
					}else{
						chmod($dir, 0777);
					}
				}
				move_uploaded_file($data['varImageFlag']['tmp_name'], $dir.$file_name);
				chmod($dir.$file_name, 0777);
				$data['varImageFlag'] = $file_name;
			} else $data['varImageFlag'] = $this->data['varImageFlag'];
			
			if ($data['varImageMap']['size']) {
				if (!empty($this->data['varImageMap'])) unlink($file_path.$this->data['varImageMap']);
				$file_pathinfo = pathinfo($data['varImageMap']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				$dir = $file_path.substr($file_name, 0, 3)."/";
				if ( ! is_dir($dir)){
					if ( ! mkdir($dir, 0777)){
						echo $data['messages'][] = 'Не удалось создать директорию для загрузки файла';
					}else{
						chmod($dir, 0777);
					}
				}
				move_uploaded_file($data['varImageMap']['tmp_name'], $dir.$file_name);
				chmod($dir.$file_name, 0777);
				$data['varImageMap'] = $file_name;
			} else $data['varImageMap'] = $this->data['varImageMap'];
			
			if (isset($data['intCountryID']) && !empty($data['intCountryID'])) {
				$this->AdvCountriesTable->Update($data);
			} else {
				$this->AdvCountriesTable->Insert($data);
				$data['intCountryID'] = $this->AdvCountriesTable->getInsertId();
			}
			
			$intCountryID = $data['intCountryID'];
			$arrTmp = array('varModuleName' => 'adv_country', 'intModuleID' => $intCountryID);
			$this->galleriesToModulesTable->DeleteByFields($arrTmp);	
			foreach($intGalleryIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'adv_country';
				$d['intModuleID'] = $data['intCountryID'];
				$d['intGalleryID'] = $value;
				$this->galleriesToModulesTable->Insert($d);
			}
			$intCountryID = $data['intCountryID'];
			$arrTmp = array('varModuleName' => 'adv_country', 'intModuleID' => $intCountryID);
			$this->bannersToModulesTable->DeleteByFields($arrTmp);	
			foreach($intBannersMainIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'adv_country';
				$d['intModuleID'] = $data['intCountryID'];
				$d['intBannerZoneID'] = $value;
				$this->bannersToModulesTable->Insert($d);
			}
			
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intCountryID']) && !empty($data['intCountryID'])) $this->response->redirect('countries_catalog_adv.edit.php?intCountryID='.$data['intCountryID']);
		}
	}

	function OnDeleteImage() {
		$data['intCountryID'] = $this->request->getNumber('intCountryID', 'NotEmpty');
		
		if($this->request->getString('varImage') != ''){
			$data['varImage'] =	$this->request->getString('varImage');
		}
		if($this->request->getString('varImageFlag') != ''){
			$data['varImageFlag'] =	$this->request->getString('varImageFlag');
		}
		if($this->request->getString('varImageMap') != ''){
			$data['varImageMap'] =	$this->request->getString('varImageMap');
		}
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки');
		} else {
			if (!empty($this->data['varImage'])) {
				if($this->request->getString('varImage') != ''){
					unlink(FILES_PATH.substr($this->data['varImage'],0,3).'/'.$this->data['varImage']);
					$this->data['varImage'] = '';
				}
				if($this->request->getString('varImageFlag') != ''){
					unlink(FILES_PATH.substr($this->data['varImage'],0,3).'/'.$this->data['varImage']);
					$this->data['varImageFlag'] = '';
				}
				if($this->request->getString('varImageMap') != ''){
					unlink(FILES_PATH.substr($this->data['varImage'],0,3).'/'.$this->data['varImage']);
					$this->data['varImageMap'] = '';
				}

				$this->AdvCountriesTable->Update($this->data);
			}
		}
	}

	
	function render() {
		parent::render();
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('data', $this->data);		
		
		$this->document->addValue('countries_list', $this->CountriesTable->GetList());
		
		$this->document->addValue('banners_main_list', $this->bannersMainTable->GetList());
        $this->document->addValue('galeries_list', $this->gallerysTable->GetList());
        if($this->data['intCountryID']!='') {
		    $this->document->addValue('banners_to_modules', $this->bannersToModulesTable->GetList(array('varModuleName' => 'adv_country', 'intModuleID' => $this->data['intCountryID'])));
		    $this->document->addValue('galleries_to_modules', $this->galleriesToModulesTable->GetList(array('varModuleName' => 'adv_country', 'intModuleID' => $this->data['intCountryID'])));
        }
	}

}

Kernel::ProcessPage(new IndexPage("countries_catalog_adv.edit.tpl"));