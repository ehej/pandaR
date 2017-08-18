<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("system.page.Page");
Kernel::Import("classes.unit.FormCreator");

class IndexPage extends Page {
	public $form;
	function index() {
		parent::index();
		$this->form = new FormCreator($this->connection);
	}
	function getSessionID() {
		return PROJECT_SESSION_NAME . 'user';
	}
	
	function render() {
		parent::render();
		$this->form->SendFormData();
	}
}
Kernel::ProcessPage(new IndexPage("layout.tpl"));
