<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.ContinentTypesTable");

class IndexPage extends AdminPage {

	/**
	 *
	 * @var ContinentTypesTable
	 */
	var $continentTypesTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Континенты');
		$this->setBoldMenu('continenttypes');
		$this->continentTypesTable = new ContinentTypesTable($this->connection);
	}
	
	function OnDelete() {			
		$data = array('intTypeID'=>$this->request->getNumber('intTypeID'));		
		$this->continentTypesTable->delete($data);
		$this->response->redirect('continenttypes.php');
		$this->addMessage('Континент удален из списка');	
	}

	function OnSaveOrder() {		
		$orders = $this->request->Value('order');
		if (is_array($orders)) {
			foreach ($orders as $k => $v) {
				$i = 0;
				$ids = explode(",", $v);
				foreach ($ids as $k => $id) {
					$menu = $this->continentTypesTable->get(array('intTypeID' => $id));
					$menu['intSortOrder'] = $i++;
					$this->continentTypesTable->update($menu);
				}
			}
		}
		$this->addMessage('Порядок следования типов континентов был сохранен');				
	}
	
	function render() {
		parent::render();

		$pages = $this->continentTypesTable->GetList(null, array('intSortOrder' => 'ASC'));	
		$this->document->addValue('continenttypes_list', $pages);		
	}	
	
}

Kernel::ProcessPage(new IndexPage("continenttypes.tpl"));