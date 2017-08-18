<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("system.mail.*");

class IndexPage extends PublicPage {
	
	var $data;
	
	function index() {
		parent::index();

		$this->setPageTitle('Обратная связь');
	}

	function OnFeedback() {
		$captcha = $this->request->getString('Captcha', 'NotEmpty');
		$data['varFIO'] = $this->request->getString('varFIO', 'NotEmpty');
		$data['varPhone'] = $this->request->getString('varPhone', 'NotEmpty');
		$data['varEmail'] = $this->request->getString('varEmail', 'NotEmpty');
		$data['varName'] = $this->request->getString('varName', 'NotEmpty');
		$data['varCity'] = $this->request->getString('varCity', 'NotEmpty');
		$data['varText'] = $this->request->getString('varText', 'NotEmpty');
		
		if ($captcha != $this->session->Get('captcha_keystring')) {
			$this->addErrorMessage('Не верный цифровой код');
			$this->data = $data;
			$this->document->addValue('flag', 'false');
		} else {
			if (!$this->request->getErrors()) {
				$smarty = new Smarty();
				$smarty->template_dir = TEMPLATES_PATH.'mail/';
				$smarty->compile_dir = PROJECT_CACHE.'smarty/';
				$smarty->config_dir = TEMPLATES_PATH.'mail/';
				$smarty->cache_dir = PROJECT_CACHE.'smarty/';
				$smarty->caching = (int)ENABLE_TEMPLATES_CACHE;
				$smarty->cache_lifetime = 1;
				$smarty->debugging = ENABLE_INTERNAL_DEBUG;
				$smarty->assign('data', $data);
				
				@mail(	PROJECT_TO_MAIL, 
						'Собщение обратной связи',
						$smarty->fetch('feedback.eml'), 
						'Content-Type: text/html; charset="utf-8"' );
						
				$this->document->addValue('flag', 'true');
			} else {
				$this->data = $data;
				$this->document->addValue('flag', 'false');
			}
		}
	}
	
	function render() {
		parent::render();
			
		$this->document->addValue('data', $this->data);
		$this->breadCrumbs = array(
			array(
				'title'=>'Главная',
				'url'=>'/',
				'thisPage'=>false
			),
			array(
				'title'=>'Обратная связь',
				'url'=>'',
				'thisPage'=>true
			)
		);
		$this->document->addValue('breadCrumbs', $this->breadCrumbs);	
	}
}

Kernel::ProcessPage(new IndexPage("feedback.tpl"));