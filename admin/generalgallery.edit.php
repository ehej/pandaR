<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.GeneralGalleryTable");

class IndexPage extends AdminPage {


	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных зоны');
		$this->setBoldMenu('generalgallery');
			
		$this->BannerZoneTable = new GeneralGalleryTable($this->connection);
			
		$this->intGeneralGalleryID = $this->request->getNumber('intGeneralGalleryID', 0);
		
		if ($this->intGeneralGalleryID) {
			$this->data = $this->BannerZoneTable->Get(array('intGeneralGalleryID' => $this->intGeneralGalleryID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет зоны с заданным ID');
				$this->response->redirect('generalgallery.php');
			}
		}
	}
		
 	function OnSave() {
		$data['intGeneralGalleryID'] = $this->request->getNumber('intGeneralGalleryID');
		$data['varDescription'] =	$this->request->getString('varDescription');
		$data['varLink'] =	$this->request->getString('varLink');
		$data['varName'] =	$this->request->getString('varName', 'NotEmpty');
		$data['intOrder'] = $this->request->getNumber('intOrder');
		$data['intPublish'] =	$this->request->getNumber('intPublish');
		$data['varImage'] = $this->request->getFiles('varImage', 'NotEmpty');
		$delete_image = $this->request->getNumber('delete_image');
		
		if ($data['varImage']['size']) {
			$file_path = IMG_BANNER_ZONE_PATH;
			if(!is_dir($file_path)){mkdir($file_path, 0777);}
			if (!empty($this->data['varImage'])) unlink($file_path.$this->data['varImage']);
			$file_pathinfo = pathinfo($data['varImage']['name']);
			$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
			move_uploaded_file($data['varImage']['tmp_name'], $file_path.$file_name);
			chmod($file_path.$file_name, 0777);
			$data['varImage'] = $file_name;
		} elseif($delete_image != 1) {
			$data['varImage'] = $this->data['varImage'];
		}else{
			$data['varImage'] = '';
		}
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			
			if (!empty($data['intGeneralGalleryID'])) {
				$this->BannerZoneTable->Update($data);
			} else {
				$this->BannerZoneTable->Insert($data);
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intGeneralGalleryID']) && !empty($data['intGeneralGalleryID'])) $this->response->redirect('generalgallery.edit.php?intGeneralGalleryID='.$data['intGeneralGalleryID']);
		}
	}
	
	function render() {
		parent::render();
		$this->document->addValue('data', $this->data);

		$this->document->addValue('path', IMG_BANNER_ZONE_URL);	
	}

}

Kernel::ProcessPage(new IndexPage("generalgallery.edit.tpl"));