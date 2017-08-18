<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.GuestBookTable");
Kernel::Import("classes.data.ModulesPagesTable");

class IndexPage extends PublicPage {

	var $GuestBookTable;
	var $modulesPagesTable;
	
	var $page = 1;
	
	function index() {
		parent::index();

		$this->GuestBookTable = new GuestBookTable($this->connection);
		$this->modulesPagesTable = new ModulesPagesTable($this->connection);
		
		$fields = $this->modulesPagesTable->GetByFields(array('varPage' => 'guest_book'), null, true);
		$this->setPageTitle($fields['varMetaTitle'], $fields['varMetaKeywords'], $fields['varMetaDescription']);
		
		$this->setFilters();
	}
	
	function OnAdd(){
		$captcha = $this->request->getString('Captcha', 'NotEmpty');
		$data['varName'] = $this->request->getString('varName', 'NotEmpty');
		$data['varText'] = $this->request->getString('varText', 'NotEmpty');
		$data['varEmail'] = $this->request->getString('varEmail');
		$data['varSite'] = $this->request->getString('varSite');
		$data['intStatus'] = 0;
		$data['varDate'] = date("Y-m-d H:i:s");
		
		if ($captcha != $this->session->Get('captcha_keystring')) {
			$this->addErrorMessage('Не верный цифровой код');
			$this->document->addValue('GBData', $data);
			$this->document->addValue('commentFlag', 'false');
		} else {
			if (!$this->request->getErrors()) {
				$this->GuestBookTable->Insert($data);
				$this->addMessage('Ваше сообшение добавлено, после модерации оно будет доступно.');
				$this->response->redirect('/guest-book');
			} else {
				$this->addErrorMessage('Не верно заполнены поля');
				$this->document->addValue('GBData', $data);
			}
		}
	}

	function setFilters() {
		$this->sfilter['intStatus'] = 1;
		if ($this->request->getString('sbutton')) $this->page = 1;
		else $this->page = $this->request->getNumber('page', null, 1);
	}
	
	function render() {
		parent::render();

		$this->document->addValue('sfilter', $this->sfilter);		
		$tmp = array();
		$GB = $this->GuestBookTable->GetList($this->sfilter, array('varDate'=>'DESC'), null, null, 'getSQLRows', true, $this->page, DEFAULT_ITEMSPERPAGE);
	
		$this->document->addValue('data', $GB);
		$this->breadCrumbs = array(
			array(
				'title'=>'Главная',
				'url'=>'/',
				'thisPage'=>false
			),
			array(
				'title'=>'Гостевая книга',
				'url'=>'',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);	
		
	}
}

Kernel::ProcessPage(new IndexPage("guest_book.tpl"));