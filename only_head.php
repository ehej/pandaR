<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");

class IndexPage extends PublicPage {

	function index() {
		parent::index();
		$this->response->maintemplate = "layout/header_block.tpl";
		//$this->document->addValue('messages', $messages);
	}

	function render() {
		parent::render();
		header ('Content-type: text/html; charset=utf-8');
		$cont = $this->response->displayContent();
		preg_replace('traget/s*=/s*"[^"]','',$cont);
		$cont = str_replace('<a ', '<a target="_parent"', $cont);
		
		
		echo $cont;
		die();
	}
}

Kernel::ProcessPage(new IndexPage("void.tpl"));