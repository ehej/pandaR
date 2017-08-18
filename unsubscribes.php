<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.SubscribesTable");

class IndexPage extends PublicPage {

	var $subscribesTable;	
	var $data = false;

	function index() {
		parent::index();
		$this->setPageTitle('Отписатся от рассылки');	
		$this->subscribesTable = new subscribesTable($this->connection);		
	}

 	function OnUnsubscribes() {
 		
		$data['varEmail'] =	$this->request->getString('varEmail', 'Email');
		$data['varName'] = $this->request->getString('varName', 'NotEmpty');		
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			$subs = $this->subscribesTable->GetByFields($data);
			if(empty($subs)){
				$this->data = $data;
				$this->addErrorMessage('Введите верные данные для отписки от рассылки');
			}else{
				$this->addMessage('Вы отписались от рассылки');
				$this->subscribesTable->Delete($subs);
				$this->response->redirect('unsubscribes.php');
			}
			
		}
	}

	function render() {
		parent::render();	
		$this->document->addValue('data_subs', $this->data);	
		$this->breadCrumbs = array(
			array(
				'title'=>'Главная',
				'url'=>'/',
				'thisPage'=>false
			),
			array(
				'title'=>'Отписатся от рассылки',
				'url'=>'/unsubscribes',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);		
	}

}

Kernel::ProcessPage(new IndexPage("unsubscribes.tpl"));