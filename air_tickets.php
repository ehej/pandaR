<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");

class IndexPage extends PublicPage {
	
	function index() {
		parent::index();

		$this->setPageTitle('Авиабилеты');
	}

	function render() {
		parent::render();
	}
}

Kernel::ProcessPage(new IndexPage("air_tickets.tpl"));