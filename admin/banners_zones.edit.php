<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.BannersMainTable");
Kernel::Import("classes.data.BannersToModulesTable");

class IndexPage extends AdminPage {

	/**
	 * @var BannersMainTable
	 */
	var $bannersMainTable;
	/**
	 * @var BannersToModulesTable
	 */
	var $bannersToModulesTable;
	
	var $data = false;

	function index() {
		parent::index();
		
		$this->setPageTitle('Баннерные зоны');
		$this->setBoldMenu('banners_zones');
		
		$this->bannersMainTable = new BannersMainTable($this->connection);
		$this->bannersToModulesTable = new BannersToModulesTable($this->connection);
		
		$intBannerZoneID = $this->request->getNumber('intBannerZoneID', 0);
		if ($intBannerZoneID) {
			$this->data = $this->bannersMainTable->Get(array('intBannerZoneID' => $intBannerZoneID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет баннерной зоны с заданным ID');
				$this->response->redirect('banners_zones.php');
			}
		}
	}

 	function OnSave() {
		$data['intBannerZoneID'] = $this->request->getNumber('intBannerZoneID');
		$data['varName'] = $this->request->getString('varName', 'NotEmpty');
		$data['varBanner1Name'] = $this->request->getFiles('varBanner1Name');
		$data['varLink1'] = $this->request->getString('varLink1');
		$data['varBanner2Name'] = $this->request->getFiles('varBanner2Name');
		$data['varLink2'] = $this->request->getString('varLink2');
		$data['varBanner3Name'] = $this->request->getFiles('varBanner3Name');
		$data['varLink3'] = $this->request->getString('varLink3');
		$data['varBanner4Name'] = $this->request->getFiles('varBanner4Name');
		$data['varLink4'] = $this->request->getString('varLink4');
		$data['varBanner5Name'] = $this->request->getFiles('varBanner5Name');
		$data['varLink5'] = $this->request->getString('varLink5');
		$data['varBanner6Name'] = $this->request->getFiles('varBanner6Name');
		$data['varLink6'] = $this->request->getString('varLink6');
		$data['varBanner7Name'] = $this->request->getFiles('varBanner7Name');
		$data['varLink7'] = $this->request->getString('varLink7');
		$data['varBanner8Name'] = $this->request->getFiles('varBanner8Name');
		$data['varLink8'] = $this->request->getString('varLink8');
		$data['isShowSection_1'] = $this->request->getNumber('isShowSection_1');
		$data['isShowSection_2'] = $this->request->getNumber('isShowSection_2');
		$data['intWidth1'] = $this->request->getNumber('intWidth1');
		$data['intHeight1'] = $this->request->getNumber('intHeight1');
		$data['intWidth2'] = $this->request->getNumber('intWidth2');
		$data['intHeight2'] = $this->request->getNumber('intHeight2');
		$data['intWidth3'] = $this->request->getNumber('intWidth3');
		$data['intHeight3'] = $this->request->getNumber('intHeight3');
		$data['intWidth4'] = $this->request->getNumber('intWidth4');
		$data['intHeight4'] = $this->request->getNumber('intHeight4');
		$data['intWidth5'] = $this->request->getNumber('intWidth5');
		$data['intHeight5'] = $this->request->getNumber('intHeight5');
		$data['intWidth6'] = $this->request->getNumber('intWidth6');
		$data['intHeight6'] = $this->request->getNumber('intHeight6');
		$data['intWidth7'] = $this->request->getNumber('intWidth7');
		$data['intHeight7'] = $this->request->getNumber('intHeight7');
		$data['intWidth8'] = $this->request->getNumber('intWidth8');
		$data['intHeight8'] = $this->request->getNumber('intHeight8');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if ($data['varBanner1Name']['size']) {
				$data['varBanner1RealName'] = $data['varBanner1Name']['name'];
				$file_path = FILES_PATH;
				if (!empty($this->data['varBanner1Name'])) unlink($file_path.$this->data['varBanner1Name']);
				$file_pathinfo = pathinfo($data['varBanner1Name']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varBanner1Name']['tmp_name'], $file_path.$file_name);
				chmod($file_path.$file_name, 0777);
				$data['varBanner1Name'] = $file_name;
			} else $data['varBanner1Name'] = $this->data['varBanner1Name'];
			
			if ($data['varBanner2Name']['size']) {
				$data['varBanner2RealName'] = $data['varBanner2Name']['name'];
				$file_path = FILES_PATH;
				if (!empty($this->data['varBanner2Name'])) unlink($file_path.$this->data['varBanner2Name']);
				$file_pathinfo = pathinfo($data['varBanner2Name']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varBanner2Name']['tmp_name'], $file_path.$file_name);
				chmod($file_path.$file_name, 0777);
				$data['varBanner2Name'] = $file_name;
			} else $data['varBanner2Name'] = $this->data['varBanner2Name'];
			
			if ($data['varBanner3Name']['size']) {
				$data['varBanner3RealName'] = $data['varBanner3Name']['name'];
				$file_path = FILES_PATH;
				if (!empty($this->data['varBanner3Name'])) unlink($file_path.$this->data['varBanner3Name']);
				$file_pathinfo = pathinfo($data['varBanner3Name']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varBanner3Name']['tmp_name'], $file_path.$file_name);
				chmod($file_path.$file_name, 0777);
				$data['varBanner3Name'] = $file_name;
			} else $data['varBanner3Name'] = $this->data['varBanner3Name'];
			
			if ($data['varBanner4Name']['size']) {
				$data['varBanner4RealName'] = $data['varBanner4Name']['name'];
				$file_path = FILES_PATH;
				if (!empty($this->data['varBanner4Name'])) unlink($file_path.$this->data['varBanner4Name']);
				$file_pathinfo = pathinfo($data['varBanner4Name']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varBanner4Name']['tmp_name'], $file_path.$file_name);
				chmod($file_path.$file_name, 0777);
				$data['varBanner4Name'] = $file_name;
			} else $data['varBanner4Name'] = $this->data['varBanner4Name'];
			
			if ($data['varBanner5Name']['size']) {
				$data['varBanner5RealName'] = $data['varBanner5Name']['name'];
				$file_path = FILES_PATH;
				if (!empty($this->data['varBanner5Name'])) unlink($file_path.$this->data['varBanner5Name']);
				$file_pathinfo = pathinfo($data['varBanner5Name']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varBanner5Name']['tmp_name'], $file_path.$file_name);
				chmod($file_path.$file_name, 0777);
				$data['varBanner5Name'] = $file_name;
			} else $data['varBanner5Name'] = $this->data['varBanner5Name'];
			
			if ($data['varBanner6Name']['size']) {
				$data['varBanner6RealName'] = $data['varBanner6Name']['name'];
				$file_path = FILES_PATH;
				if (!empty($this->data['varBanner6Name'])) unlink($file_path.$this->data['varBanner6Name']);
				$file_pathinfo = pathinfo($data['varBanner6Name']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varBanner6Name']['tmp_name'], $file_path.$file_name);
				chmod($file_path.$file_name, 0777);
				$data['varBanner6Name'] = $file_name;
			} else $data['varBanner6Name'] = $this->data['varBanner6Name'];
			
			if ($data['varBanner7Name']['size']) {
				$data['varBanner7RealName'] = $data['varBanner7Name']['name'];
				$file_path = FILES_PATH;
				if (!empty($this->data['varBanner7Name'])) unlink($file_path.$this->data['varBanner7Name']);
				$file_pathinfo = pathinfo($data['varBanner7Name']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varBanner7Name']['tmp_name'], $file_path.$file_name);
				chmod($file_path.$file_name, 0777);
				$data['varBanner7Name'] = $file_name;
			} else $data['varBanner7Name'] = $this->data['varBanner7Name'];
			
			if ($data['varBanner8Name']['size']) {
				$data['varBanner8RealName'] = $data['varBanner8Name']['name'];
				$file_path = FILES_PATH;
				if (!empty($this->data['varBanner8Name'])) unlink($file_path.$this->data['varBanner8Name']);
				$file_pathinfo = pathinfo($data['varBanner8Name']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varBanner8Name']['tmp_name'], $file_path.$file_name);
				chmod($file_path.$file_name, 0777);
				$data['varBanner8Name'] = $file_name;
			} else $data['varBanner8Name'] = $this->data['varBanner8Name'];
			
			if (isset($data['intBannerZoneID']) && !empty($data['intBannerZoneID'])) {
				$this->bannersMainTable->Update($data);
			} else {
				$this->bannersMainTable->Insert($data);
			}
			
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intBannerZoneID']) && !empty($data['intBannerZoneID'])) $this->response->redirect('banners_zones.edit.php?intBannerZoneID='.$data['intBannerZoneID']);
		}
	}

	function OnDeleteBanner() {
		$data['intBannerZoneID'] = $this->request->getNumber('intBannerZoneID', 'NotEmpty');
		$data['varBannerName'] = $this->request->getString('varBannerName', 'NotEmpty');
		$intBannerPos = $this->request->getNumber('intBannerPos', 'NotEmpty');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки');
		} else {
			if (!empty($data['varBannerName'])) {
				unlink(FILES_PATH.$data['varBannerName']);
				$this->data['varBanner'.$intBannerPos.'Name'] = '';
				$this->data['varBanner'.$intBannerPos.'RealName'] = '';
				$this->bannersMainTable->Update($this->data);
			}
		}
		$this->response->redirect('banners_zones.edit.php?intBannerZoneID='.$data['intBannerZoneID']);
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('data', $this->data);
	}

}

Kernel::ProcessPage(new IndexPage("banners_zones.edit.tpl"));