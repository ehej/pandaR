<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");

class LogonPage extends AdminPage {

	function Authenticate() {}

	function __construct($Template) {
		parent::__construct($Template);
		$this->response = new SmartyResponse($this, $this->document, 'void.tpl'); // set void layout

		$this->setPageTitle('Вход');
	}

	

	function render() {
		parent::render();
		$target = base64_decode($this->request->getString('q'));
		if (!empty($target)) {
			$this->document->addValue('logon_target', base64_encode($target));
		}
	}
}

Kernel::ProcessPage(new LogonPage("logon.tpl"));