<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.NewsTable");
Kernel::Import("classes.data.NewsTypeTable");
Kernel::Import("classes.data.GallerysTable");
Kernel::Import("classes.data.BannersMainTable");
Kernel::Import("classes.data.GalleriesToModulesTable");
Kernel::Import("classes.data.BannersToModulesTable");
Kernel::Import("classes.data.ContestsTable");

class IndexPage extends AdminPage {

	/**
	 * 
	 * @var NewsTable
	 */
	var $newsTable;
	
	/**
	 * 
	 * @var NewsTypeTable
	 */
	var $NewsTypeTable;
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
	
	var $data = false;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных новости');
		$this->setBoldMenu('news');		
		
		$this->newsTable = new NewsTable($this->connection);	
		$this->NewsTypeTable = new NewsTypeTable($this->connection);	
		$this->gallerysTable = new GallerysTable($this->connection);
		$this->galleriesToModulesTable = new GalleriesToModulesTable($this->connection);
		$this->bannersToModulesTable = new BannersToModulesTable($this->connection);
		$this->bannersMainTable = new BannersMainTable($this->connection);
		$this->contestsTable = new ContestsTable($this->connection);
		
		$intNewsID = $this->request->getNumber('intNewsID', 0);
		if ($intNewsID) {
			$this->data = $this->newsTable->Get(array('intNewsID' => $intNewsID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет новости с заданным ID');
				$this->response->redirect('news.php');
			}
		}
	}

 	function OnSave() {
		$data['intNewsID'] = $this->request->getNumber('intNewsID');
		$data['intNewsTypeID'] = $this->request->getNumber('intNewsTypeID');
		$data['varTitle'] =	$this->request->getString('varTitle', 'NotEmpty');
		$data['varAnnotation'] = $this->request->getString('varAnnotation');
		$data['varMetaTitle'] = $this->request->getString('varMetaTitle');
		$data['varMetaKeywords'] = $this->request->getString('varMetaKeywords');
		$data['varMetaDescription'] = $this->request->getString('varMetaDescription');
		$data['intContestID'] = $this->request->getNumber('intContestID');
		$data['varDescription'] = $this->request->getString('varDescription', 'NotEmpty');
		$data['intOnlyAuthorized'] = $this->request->getNumber('intOnlyAuthorized', 0);
		$data['intActive'] = $this->request->getNumber('intActive', 0);
		$data['varShowComments'] = $this->request->getString('varShowComments');
		$data['intShowHome'] = $this->request->getString('intShowHome');
		if(!$data['varShowComments']) $data['varShowComments'] = 'no';
		/*if(!$data['intNewsID']){
			$data['varDate'] = date('Y-m-d H:i:s');
		}*/
		$data['varDate'] = $this->request->Value('varDateYear').'-'
							.$this->request->Value('varDateMonth').'-'
							.$this->request->Value('varDateDay').' '
							.$this->request->Value('varDateHour').':'
							.$this->request->Value('varDateMinute').':'
							.$this->request->Value('varDateSecond');
		$intGalleryIDList = $this->request->Value('intGalleryID');
		$intBannersMainIDList = $this->request->Value('intBannerZoneID');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			
			if ($data['intNewsID']) {
				$this->newsTable->Update($data);
			} else {
				$this->newsTable->Insert($data);
			}
			
			$arrTmp = array('varModuleName' => 'news', 'intModuleID' => $data['intNewsID']);
			$this->galleriesToModulesTable->DeleteByFields($arrTmp);	
			foreach($intGalleryIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'news';
				$d['intModuleID'] = $data['intNewsID'];
				$d['intGalleryID'] = $value;
				$this->galleriesToModulesTable->Insert($d);
			}
			
			$intNewsID = $data['intNewsID'];
			$arrTmp = array('varModuleName' => 'news', 'intModuleID' => $data['intNewsID']);
			$this->bannersToModulesTable->DeleteByFields($arrTmp);	
			foreach($intBannersMainIDList as $key => $value) {
				$d = array();
				$d['varModuleName'] = 'news';
				$d['intModuleID'] = $data['intNewsID'];
				$d['intBannerZoneID'] = $value;
				$this->bannersToModulesTable->Insert($d);
			}
			
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intNewsID']) && !empty($data['intNewsID'])) $this->response->redirect('news.edit.php?intNewsID='.$data['intNewsID']);
		}
	}

	function render() {
		parent::render();
		
		$this->document->addValue('data', $this->data);
		$this->document->addValue('contests', $this->contestsTable->GetList());	
		$this->document->addValue('galeries_list', $this->gallerysTable->GetList());
		$this->document->addValue('banners_main_list', $this->bannersMainTable->GetList());
        if($this->data['intNewsID']!='') {
		    $this->document->addValue('galleries_to_modules', $this->galleriesToModulesTable->GetList(array('varModuleName' => 'news', 'intModuleID' => $this->data['intNewsID'])));
		    $this->document->addValue('banners_to_modules', $this->bannersToModulesTable->GetList(array('varModuleName' => 'news', 'intModuleID' => $this->data['intNewsID'])));
        }
        $news_type = $this->NewsTypeTable->GetList(null, array('intOrdering'=>'DESC'));
		foreach ($news_type as $value) {
			$tmp[$value['intNewsTypeID']] = $value['varNameType'];
		}
		$news_type = $tmp;
		$this->document->addValue('news_type_list', $news_type);
	}

}

Kernel::ProcessPage(new IndexPage("news.edit.tpl"));