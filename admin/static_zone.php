<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.StaticZoneTable");
Kernel::Import("classes.data.StaticZonePositionTable");

class IndexPage extends AdminPage {

	var $StaticZoneTable;
	var $StaticZonePositionTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		$this->setPageTitle('Статические зоны сайта');
		$this->setBoldMenu('static_zone');
		
		$this->StaticZoneTable = new StaticZoneTable($this->connection);
		$this->StaticZonePositionTable = new StaticZonePositionTable($this->connection);
		
		$this->setFilters();
	}
	
	function OnDelete() {
		$this->addMessage('Зона удалена');		
		$data = array('intSZID' => $this->request->getNumber('intSZID'));		
		$this->StaticZoneTable->delete($data);
		$this->response->redirect('static_zone.php');
	}
	
	function OnSave() {
		$orderings = $this->request->Value('intOrdering');

		foreach($orderings as $key=>$ordering) {
			$data = array('intOrdering'=>$ordering, 'intSZID'=>$key);
			$this->StaticZoneTable->Update($data);
		}
		$this->addMessage('Данные успешно сохранены');
		$this->response->redirect('static_zone.php');

	}

	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy', null, 'varPosition');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder', null, 1);

		if ( ($name = $this->request->getString('varText')) && !empty($name)) $this->sfilter['LIKEvarText'] = $name;
		
		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}
	
	function render() {
		parent::render();
		
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC';	
		$sort['intOrdering'] = 'ASC';
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);

		$static_zone = $this->StaticZoneTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		$this->document->addValue('static_zone', $static_zone);
		$tmp = $this->StaticZonePositionTable->getList();
		foreach ($tmp as $value) {
			$pos[$value['varPosition']] =$value['varNamePosition'];
		}
		$this->document->addValue('position', $pos);	
	}	
	
}

Kernel::ProcessPage(new IndexPage("static_zone.tpl"));