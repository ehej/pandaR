<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.BottomLinksTable");

class IndexPage extends AdminPage {

	/**
	 * @var BottomLinksTable
	 */
	public $BottomLinksTable;

	function index() {
		parent::index();
		
		$this->setPageTitle('Ссылки внизу');
		$this->setBoldMenu('bottomLinks');
		
		$this->bottomLinksTable = new BottomLinksTable($this->connection);
	}
	
	function OnDelete() {
		$this->addMessage('Ссылка удалена');		
		$intBottomLinkID = $this->request->getNumber('intBottomLinkID');		
		$this->deleteMenu($intBottomLinkID);
		$this->response->redirect('bottom_links.php');
	}	
	
	function OnSaveOrder() {	
		$intBottomLinkID = $this->request->getNumber('intBottomLinkID');
		$orders = $this->request->Value('order');
		if (is_array($orders)) {
			foreach ($orders as $k => $v) {
				$i = 0;
				$ids = explode(",", $v);
				foreach ($ids as $k => $id) {
					$menu = $this->bottomLinksTable->get(array('intBottomLinkID' => $id));
					$menu['intSortOrder'] = $i++;
					$this->bottomLinksTable->update($menu);
				}	
			}
		}
		$this->addMessage('Порядок ссылок сохранен');
		$this->response->redirect('bottom_links.php');	
	}
	
	function render() {
		parent::render();		
		
		$this->document->addValue('bottom_links', $this->bottomLinksTable->GetList(null, array('intSortOrder' => 'asc')));	
	}
	
	function deleteMenu($intMenuID) {
		$data = array('intMenuID' => $intMenuID);
		$this->bottomLinksTable->delete($data);					
	}
	
}

Kernel::ProcessPage(new IndexPage("bottom_links.tpl"));