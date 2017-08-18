<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.SubscribesTable");
Kernel::Import('system.mail.*');

class IndexPage extends PublicPage {

	var $subscribesTable;	
	var $data = false;
	var $undata = false;

	function index() {
		parent::index();
	}
	
	function onActivate(){
		$this->subscribesTable = new subscribesTable($this->connection);		
		$data['hash'] =	$this->request->getString('hash');
		if ($this->request->getErrors()) {
		} else {
			$dat = $this->subscribesTable->GetByFields(array('varHash'=>$data['hash']));
			if($dat > 0){
				$dat['isActive'] = 1;
				$this->subscribesTable->Update($dat);
				$this->addMessage('Спасибо за активацию Email');
			}
		}
		$this->response->redirect('/');
	}

	function render() {
		parent::render();		
	}

}

Kernel::ProcessPage(new IndexPage(""));