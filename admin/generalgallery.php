<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.GeneralGalleryTable");

class IndexPage extends AdminPage {


	function index() {
		parent::index();
		$this->setPageTitle('Слайдер');
		$this->setBoldMenu('generalgallery');
		
		$this->BannerZoneTable = new GeneralGalleryTable($this->connection);

	}
	
	function OnDelete() {
		$this->addMessage('Зона удалена');		
		$data = array('intGeneralGalleryID' => $this->request->getNumber('intGeneralGalleryID'));
		$this->BannerZoneTable->delete($data);
		$this->response->redirect('generalgallery.php');
	}

	function setFilters() {
		$this->sfilter['sortBy'] = $this->request->getString('sortBy');
		$this->sfilter['sortOrder'] = $this->request->getNumber('sortOrder');

		if ( ($name = $this->request->getString('varText')) && !empty($name)) $this->sfilter['LIKEvarText'] = $name;
		
		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', 1);
	}
	
	function render() {
		parent::render();
		
		if (!empty($this->sfilter['sortBy'])) $sort[$this->sfilter['sortBy']] = ($this->sfilter['sortOrder']) ? 'ASC' : 'DESC';	
		$this->document->addValue('filter', $this->sfilter);
		$this->document->addValue('sortBy', $this->sfilter['sortBy']);
		$this->document->addValue('sortOrder', $this->sfilter['sortOrder']);

		$banner_zone = $this->BannerZoneTable->GetList($this->sfilter, $sort, null, null, null, true, $this->page, DEFAULT_ITEMSPERPAGE);	
		$this->document->addValue('banner_zone', $banner_zone);
	}	
	
}

Kernel::ProcessPage(new IndexPage("generalgallery.tpl"));