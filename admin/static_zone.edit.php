<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.StaticZoneTable");
Kernel::Import("classes.data.StaticZonePositionTable");

class IndexPage extends AdminPage {

	var $StaticZoneTable;
	var $StaticZonePositionTable;
	
	var $data = false;
	
	var $intSZID;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных зоны');
		$this->setBoldMenu('static_zone');	
			
		$this->StaticZoneTable = new StaticZoneTable($this->connection);
		$this->StaticZonePositionTable = new StaticZonePositionTable($this->connection);
			
		$this->intSZID = $this->request->getNumber('intSZID', 0);
		
		if ($this->intSZID) {
			$this->data = $this->StaticZoneTable->Get(array('intSZID' => $this->intSZID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет зоны с заданным ID');
				$this->response->redirect('static_zone.php');
			}
		}
	}
		
 	function OnSave() {
		$data['intSZID'] = $this->request->getNumber('intSZID');
		$data['varPosition'] =	$this->request->getString('varPosition', 'NotEmpty');
		$data['varText'] =	$this->request->getString('varText');
		$data['intOrdering'] = $this->request->getNumber('intOrdering');
		$data['isActive'] =	$this->request->getNumber('isActive');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			
			if (!empty($data['intSZID'])) {
				$this->StaticZoneTable->Update($data);
			} else {
				$this->StaticZoneTable->Insert($data);
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intSZID']) && !empty($data['intSZID'])) $this->response->redirect('static_zone.edit.php?intSZID='.$data['intSZID']);
		}
	}
	
	function render() {
		parent::render();
		$this->document->addValue('data', $this->data);
		$tmp = $this->StaticZonePositionTable->getList();
		foreach ($tmp as $value) {
			$pos[$value['varPosition']] =$value['varNamePosition'];
		}
		$this->document->addValue('position', $pos);	
	}

}

Kernel::ProcessPage(new IndexPage("static_zone.edit.tpl"));