<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.ToursTable");
Kernel::Import("classes.data.SeminarOrdersTable");
Kernel::Import("classes.data.FoodTypesTable");
Kernel::Import("classes.data.PlaceTypesTable");
Kernel::Import("system.mail.*");

class IndexPage extends PublicPage {
	
	var $data;
	
	function index() {
		parent::index();

		$this->toursTable = new ToursTable($this->connection);
		$this->FoodTypesTable = new FoodTypesTable($this->connection);
		$this->PlaceTypesTable = new PlaceTypesTable($this->connection);
		$this->ToursTransportTable = new ToursTransportTable($this->connection);
		$this->SeminarOrdersTable = new SeminarOrdersTable($this->connection);

		$this->setPageTitle('Заявка на семинар');
	}

	function OnOrder() {
		$data['varFIO'] = $this->request->getString('varFIO', 'NotEmpty');
		$data['varCompanyName'] = $this->request->getString('varCompanyName', 'NotEmpty');
		$data['varMail'] = $this->request->getString('varMail', 'NotEmpty');
		$data['varCityName'] = $this->request->getString('varCityName', 'NotEmpty');
		$data['varTel'] = $this->request->getString('varTel', 'NotEmpty');
		$data['varComments'] = $this->request->getString('varComments');
		$data['intCountPeople'] = $this->request->getNumber('intCountPeople', 'NotEmpty');

		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->document->addValue('flag', 'false');
		} else {
			if (!$this->request->getErrors()) {
				$this->SeminarOrdersTable->Insert($data);

				$msg = new MailMessage();
				$msg->setFrom(PROJECT_FROM_MAIL);
				$msg->setSubject('Заявка на семинар');
				$msg->setHeader('BCC', 'happy@panda.fm, rosa@panda.fm, avia@panda.fm');
				
				$smarty = new Smarty();
				$smarty->template_dir = TEMPLATES_PATH.'mail/';
				$smarty->compile_dir = PROJECT_CACHE.'smarty/';
				$smarty->config_dir = TEMPLATES_PATH.'mail/';
				$smarty->cache_dir = PROJECT_CACHE.'smarty/';
				$smarty->caching = (int)ENABLE_TEMPLATES_CACHE;
				$smarty->cache_lifetime = 1;
				$smarty->debugging = ENABLE_INTERNAL_DEBUG;
				$smarty->assign('data', $data);
				$smarty->assign('PROJECT_URL', PROJECT_URL);

				$body = $smarty->fetch('order.eml');
				$msg->setBody($body);
				
				new SendMailMessage(PROJECT_TO_MAIL, $msg);

				$this->addMessage('Ваша заявка отправлена');
				$this->response->redirect( "/seminary" );
			} else {
				$this->data = $data;
				$this->addErrorMessage('Исправьте ошибки заполнения формы');
			}
		}
	}
}

Kernel::ProcessPage(new IndexPage("order.tpl"));