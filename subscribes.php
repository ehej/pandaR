<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.SubscribesTable");

class IndexPage extends PublicPage {

	var $subscribesTable;	
	var $data = false;
	var $undata = false;

	function index() {
		parent::index();
		$this->setPageTitle('Подписаться на рассылку');	
		$this->document->addValue('pagetitle2', 'Отписаться от рассылки');			
		$this->subscribesTable = new subscribesTable($this->connection);		
	}

 	function OnSubscribes() {
 		
		$data['varEmail'] =	$this->request->getString('varEmail', 'Email');
		$data['varName'] = $this->request->getString('varName', 'NotEmpty');		
		$data['varPhone'] = $this->request->getString('varPhone', 'NotEmpty');		
		$data['varCountry'] = $this->request->getString('varCountry', 'NotEmpty');		
		$data['varCompany'] = $this->request->getString('varCompany');		
		$data['varPost'] = $this->request->getString('varPost');		
		$data['varDateAdd'] = date('Y-m-d H:i:s');		
		
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			$this->subscribesTable->Insert($data);
			$this->addMessage('Вы добавлены в список подписчиков');
			$this->response->redirect('subscribes.php');
		}
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
				$this->undata = $data;
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
		$this->document->addValue('data_unsubs', $this->undata);	
		$this->breadCrumbs = array(
			array(
				'title'=>'Главная',
				'url'=>'/',
				'thisPage'=>false
			),
			array(
				'title'=>'Подписаться на рассылку',
				'url'=>'/subscribes',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);		
	}

}

Kernel::ProcessPage(new IndexPage("subscribes.tpl"));