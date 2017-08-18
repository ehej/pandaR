<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");

class IndexPage extends AdminPage {

	function index() {
		parent::index();
		
		$this->setPageTitle(SITE_FROM_NAME);
		
		$this->setBoldMenu('index');
	}	

	function render() {
		parent::render();
	}
}

Kernel::ProcessPage(new IndexPage("index.tpl"));
