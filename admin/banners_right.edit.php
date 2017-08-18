<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.BannersRightTable");

class IndexPage extends AdminPage {

	/**
	 * @var BannersRightTable
	 */
	var $bannersRightTable;
		
	var $data = false;
	var $intPromotionTypeID;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование баннеров справа');
		$this->setBoldMenu('banners_right');	
			
		$this->bannersRightTable = new BannersRightTable($this->connection);	
			
		$intBannerRightID = $this->request->getNumber('intBannerRightID', 0);
		if ($intBannerRightID) {
			$this->data = $this->bannersRightTable->Get(array('intBannerRightID' => $intBannerRightID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет баннера с заданным ID');
				$this->response->redirect('banners_right.php');
			}
		}
	}
		
 	function OnSave() {
		$data['intBannerRightID'] = $this->request->getNumber('intBannerRightID');
		$data['varBannerName'] = $this->request->getFiles('varBannerName', 'NotEmpty');
		$data['isShowBanner'] = $this->request->getNumber('isShowBanner');
		$data['varLink'] = $this->request->getString('varLink');
		$data['w'] = $this->request->getNumber('w');
		$data['h'] = $this->request->getNumber('h');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {	
			if ($data['varBannerName']['size']) {
				$data['varBannerRealName'] = $data['varBannerName']['name'];
				$file_path = FILES_PATH;
				if (!empty($this->data['varBannerName'])) unlink($file_path.$this->data['varBannerName']);
				$file_pathinfo = pathinfo($data['varBannerName']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varBannerName']['tmp_name'], $file_path.$file_name);
				chmod($file_path.$file_name, 0777);
				$data['varBannerName'] = $file_name;
			} else $data['varBannerName'] = $this->data['varBannerName'];
					
			if (!empty($data['intBannerRightID'])) {
				$this->bannersRightTable->Update($data);
			} else {
				$this->bannersRightTable->Insert($data);
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intBannerRightID']) && !empty($data['intBannerRightID'])) $this->response->redirect('banners_right.edit.php?intBannerRightID='.$data['intBannerRightID']);
		}
	}
	
	function OnDeleteBanner() {
		$data['intBannerRightID'] = $this->request->getNumber('intBannerRightID', 'NotEmpty');
		$data['varBannerName'] =	$this->request->getString('varBannerName', 'NotEmpty');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки');
		} else {
			if (!empty($this->data['varBannerName'])) {
				unlink(FILES_PATH.$this->data['varBannerName']);
				$this->data['varBannerName'] = '';
				$this->data['varBannerRealName'] = '';
				$this->bannersRightTable->Update($this->data);
			}
		}
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('data', $this->data);		
	}

}

Kernel::ProcessPage(new IndexPage("banners_right.edit.tpl"));