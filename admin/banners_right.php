<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.BannersRightTable");

class IndexPage extends AdminPage {

	/**
	 * @var BannersRightTable
	 */
	var $bannersRightTable;
	
	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		$this->setPageTitle('Баннеры справа');
		$this->setBoldMenu('banners_right');
		
		$this->bannersRightTable = new BannersRightTable($this->connection);
	}
	
	function OnDelete() {
		$this->addMessage('Баннер удален');		
		$data = array('intBannerRightID' =>  $this->request->getNumber('intBannerRightID'));
		$this->bannersRightTable->delete($data);	
		$this->response->redirect('banners_right.php');
	}	
	
	function OnSaveOrder() {
		$orders = $this->request->Value('order');
		if (is_array($orders)) {
			foreach ($orders as $k => $v) {
				$i = 0;
				$ids = explode(",", $v);
				foreach ($ids as $k => $id) {
					$menu = $this->bannersRightTable->Get( array('intBannerRightID' => $id));
					$menu['intSortOrder'] = $i++;
					$this->bannersRightTable->Update($menu);
				}	
			}
		}
		$this->addMessage('Порядок меню сохранен');
	}
	
	function render() {
		parent::render();		
		
		$this->document->addValue('banners_list', $this->bannersRightTable->GetList(null, array('intSortOrder' => 'asc')));	
	}
	
}

Kernel::ProcessPage(new IndexPage("banners_right.tpl"));