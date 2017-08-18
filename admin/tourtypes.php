<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.TourTypesTable");

class IndexPage extends AdminPage {

	/**
	 * @var TourTypesTable
	 */
	var $tourtypesTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		$this->setPageTitle('Виды туров');
		$this->setBoldMenu('tourtypes');
		$this->tourtypesTable = new tourtypesTable($this->connection);
	}
	
	function OnDelete() {			
		$data = array('intTypeID'=>$this->request->getNumber('intTypeID'));		
		$this->tourtypesTable->delete($data);
		$this->response->redirect('tourtypes.php');
		$this->addMessage('Тип тура удален');	
	}

	function OnSaveOrder() {		
		$orders = $this->request->Value('order');
		if (is_array($orders)) {
			foreach ($orders as $k => $v) {
				$i = 0;
				$ids = explode(",", $v);
				foreach ($ids as $k => $id) {
					$menu = $this->tourtypesTable->get(array('intTypeID' => $id));
					$menu['intSortOrder'] = $i++;
					$this->tourtypesTable->update($menu);
				}
			}
		}
		$this->addMessage('Порядок следования типов туров был сохранен');				
	}
	
	function render() {
		parent::render();

		$pages = $this->tourtypesTable->GetList(null, array('intSortOrder' => 'ASC'));	
		$this->document->addValue('tourtypes_list', $pages);		
	}	
	
}

Kernel::ProcessPage(new IndexPage("tourtypes.tpl"));