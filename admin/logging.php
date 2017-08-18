<?php
include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");

class IndexPage extends AdminPage {

	function index() {
		parent::index();
		
		$this->setPageTitle('Логирование');
		$this->setBoldMenu('logging');
	}
	
	function render() {
		parent::render();
		
		$tmp = file_get_contents(LOG_USERS_ACTION_PATH . $GLOBALS['_log']['userid'] . LOG_USERS_ACTION_EXT);
		$this->document->addValue('data', $tmp);		
	}	
	
}

Kernel::ProcessPage(new IndexPage("logging.tpl"));