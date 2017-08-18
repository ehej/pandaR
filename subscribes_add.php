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
	
		$this->subscribesTable = new subscribesTable($this->connection);		
		$data['varEmail'] =	$this->request->getString('varEmail', 'Email');
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			$dat = $this->subscribesTable->GetByFields(array('varEmail'=>$data['varEmail']));
			if(count($dat)>0){
				$this->addErrorMessage('Вы уже подписаны на рассылку');
			}else{
				$data['varHash'] = MD5($data['varEmail'].time());
				$data['varLink'] = PROJECT_URL.'subscribes_add/'.$data['varHash'];
				$data['varDateAdd'] = date('Y-m-d H:i:s');
				$msg = new MailMessage();
				$msg->setFrom(PROJECT_FROM_MAIL);
				$msg->setSubject('Подписка');
				/*
				$tmpl_root = $this->getTemplatesRoot();
				$this->setTemplatesRoot(MAIL_TEMPLATES_PATH);
				$this->response->setTemplate('void.tpl');
				$this->setTemplate('subscribes.eml');
				$this->document->addValue('data', $data);
				$body = $this->response->display();
				print_R($body);
				$this->setTemplatesRoot($tmpl_root);
				$msg->setBody($body);
				new SendMailMessage($data['varEmail'], $msg);
				*/
				$this->subscribesTable->Insert($data);
				$this->addMessage('Вы добавлены в список подписчиков');
			}
		}
		$this->response->redirect('/'.$_SERVER['QUERY_STRING']);
	}

	function render() {
		parent::render();		
	}

}

Kernel::ProcessPage(new IndexPage("subscribes.tpl"));