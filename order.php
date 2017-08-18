<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.ToursTable");
Kernel::Import("classes.data.OrdersTable");
Kernel::Import("classes.data.FoodTypesTable");
Kernel::Import("classes.data.PlaceTypesTable");
Kernel::Import("system.mail.*");

class IndexPage extends PublicPage {
	
	var $data;
	
	function index() {
		parent::index();

		$this->toursTable = new ToursTable($this->connection);
		$this->ordersTable = new OrdersTable($this->connection);
		$this->FoodTypesTable = new FoodTypesTable($this->connection);
		$this->PlaceTypesTable = new PlaceTypesTable($this->connection);
		$this->ToursTransportTable = new ToursTransportTable($this->connection);

		$this->setPageTitle('Заявка на тур');
	}

	function OnOrder() {

		$this->data = $this->toursTable->GetList(array('intTourID'=>$this->request->GetNumber('intTourID')), null, null, 'GetListWithNames');
		$data = $this->data[0];
		$data['varFIO'] = $this->request->getString('varFIO');
		$data['varTel'] = $this->request->getString('varTel', 'NotEmpty');
		$data['varMail'] = $this->request->getString('varMail', 'NotEmpty');
		$data['varComments'] = $this->request->getString('varComments');
		$data['varDateFrom'] = $this->request->getString('varDateFrom');
		$data['varDateTo'] = $this->request->getString('varDateTo');
		$data['intDays'] = $this->request->getNumber('intDays');
		$data['varTourName'] = $this->data[0]['varName'];

		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->document->addValue('flag', 'false');
		} else {
			if (!$this->request->getErrors()) {

				$this->ordersTable->Insert($data);

				$msg = new MailMessage();
				$msg->setFrom(PROJECT_FROM_MAIL);
				$msg->setSubject('Заявка на тур');
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
				$this->response->redirect('/');
			} else {
				$this->data = $data;
				$this->addErrorMessage('Исправьте ошибки заполнения формы');
			}
		}
	}
	
	function render() {
		parent::render();


		$this->data = $this->toursTable->GetList(array('intTourID'=>$this->request->GetNumber('intTourID')), null, null, 'GetListWithNamesPublic');
		$this->data = $this->data[0];
		$this->data['varFoodTypeName'] = implode(',',$this->FoodTypesTable->getByTour($this->data['intTourID']));
		$this->data['varPlaceTypeName'] = implode(',',$this->PlaceTypesTable->getByTour($this->data['intTourID']));
		$this->data['varTransport'] = implode(',',$this->ToursTransportTable->getByTour($this->data['intTourID']));
		$this->data['varResortName'] = implode(',',$this->ResortsTable->getByTour($this->data['intTourID']));
		$this->data['varTransport'] = strtr($this->data['varTransport'],array('plane'=>'Самолёт','bus'=>'Автобус','steamer'=>'Пароход','train'=>'Поезд'));
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

Kernel::ProcessPage(new IndexPage("order.tpl"));