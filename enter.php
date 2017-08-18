<?php
	include_once(dirname(__FILE__)."/classes/variables.php");

	Kernel::Import("classes.web.PublicPage");
	Kernel::Import("classes.data.UsersTable");
	Kernel::Import("classes.unit.phpmailer.phpmailer");

	class IndexPage extends PublicPage {
		/**
		 *
		 * @var usersTable
		 */
		var $usersTable;

		var $data = false;
		var $flag = false;
		
		function index() {
			parent::index();

			$this->setPageTitle('Вход');

			$this->usersTable = new UsersTable($this->connection);
			$this->mail = new PHPMailer();
		}
 
	 	function OnEnter() {
			$data['varLogin']	= 	$this->request->getString('varLogin', 	'NotEmpty');
			$data['varPassword']= 	$this->request->getString('varPassword', 'NotEmpty');

			if (!empty($data['varPassword']) && !empty($data['varLogin'])) {
				$tmp = api::getInstance()->AuthUser();
				$res = json_decode($tmp);

				if(substr($res->code,0,1)==3) {
					$_SESSION['varUser'] = $res->data->varUser;
					$res = api::getInstance()->GetUser($_SESSION['varUser']);
					$varUserData = (array)json_decode($res)->data;
					$this->session->Set('USER_DATA',$varUserData);
				} elseif($res->code==212) {
					$this->document->addValue('message', 'Вы ввели неверный логин или пароль');
				} else {
					$this->document->addValue('message', 'Ошибка авторизации');
				}
			}
			else {
				$this->document->addValue('message', 'Оба поля обязательны для заполнения.');
			}
		}

	function OnRegister() {

		$data['varLogin'] = $this->request->getString('varLogin', 'NotEmpty');
		$data['varPassword'] = $this->request->getString('varPassword', 'NotEmpty');
		$data['varRePassword'] = $this->request->getString('varRePassword', 'NotEmpty');
		$data['varName'] = $this->request->getString('varName', 'NotEmpty');
		$data['varOwnership'] = $this->request->getString('varOwnership', 'NotEmpty');
		$data['varEGRPO'] = $this->request->getString('varEGRPO', 'NotEmpty');
		$data['varUrName'] = $this->request->getString('varUrName', 'NotEmpty');
		$data['varBankGuarantee'] = $this->request->getString('varBankGuarantee', 'NotEmpty');
		$data['varTels'] = $this->request->getString('varTels', 'NotEmpty');
		$data['varFax'] = $this->request->getString('varFax', 'NotEmpty');
		$data['varEmail'] = $this->request->getString('varEmail', 'NotEmpty');
		$data['varUrIndex'] = $this->request->getString('varUrIndex', 'NotEmpty');
		$data['varUrCity'] = $this->request->getString('varUrCity', 'NotEmpty');
		$data['varUrAddress'] = $this->request->getString('varUrAddress', 'NotEmpty');
		$data['varFizIndex'] = $this->request->getString('varFizIndex', 'NotEmpty');
		$data['varFizCity'] = $this->request->getString('varFizCity', 'NotEmpty');
		$data['varFizAddress'] = $this->request->getString('varFizAddress', 'NotEmpty');
		$data['varFIO'] = $this->request->getString('varFIO', 'NotEmpty');
		$data['varCreatedTime'] = time();

		/*if($this->request->getString('varKaptcha') != $_SESSION['captcha_keystring']) {
			$this->document->addValue('varUserData', $data);
			$this->document->addValue('registerFailed', 'Неправльно введён код с картинки');
		} else {*/

			if ($this->request->getErrors() || $data['varPassword']!=$data['varRePassword']) {
				$this->document->addValue('data', $data);
				$this->addErrorMessage('Исправьте ошибки заполнения формы');
			} else {
				$isusedlogin = $this->usersTable->GetByFields(array('varLogin'=>$data['varLogin']));
				$isusedmail = $this->usersTable->GetByFields(array('varEmail'=>$data['varEmail']));

				if($isusedmail || $isusedlogin) {
					if($isusedmail) {
						$this->document->addValue('data', $data);
						$this->addErrorMessage('Такой Email уже используется');
					} else {
						$this->document->addValue('data', $data);
						$this->addErrorMessage('Такой логин уже используется');
					}
				} else {

					$this->usersTable->Insert($data);
					$url = PROJECT_URL.'?event=validation&code='.md5($data['varEmail'].'publicKEY'.$data['intUserID'].$data['varCreatedTime'].'ValidatioN');
						if($data['varEmail']) {
							$this->mail->Subject = 'Регистрация на PandaTravel';
							$this->mail->Body = 'Вы зарегистрировались на сайте PandaTravel.com.ua.<br> В ближайшее время с вами свяжутся, для проверки введенных вами данных.<br> И предоставления вам полного доступа к информации.<br>Для подтверждения Вашего Email, пожалуйста перейдите по ссылке: <a href="'.$url.'">'.$url.'</a>';
							$this->mail->From = PROJECT_FROM_MAIL;
							$this->mail->FromName = 'Admin PandaTravel';
							$this->mail->ContentType = 'text/html';
							$this->mail->AddAddress($data['varEmail']);
							$this->mail->AddCustomHeader('MIME-Version: 1.0' . "\n");
							$this->mail->CharSet = 'utf-8';
							$this->mail->Send();
							$this->mail->ClearAddresses();
							$this->mail->ClearAttachments();
							$this->mail->ClearCustomHeaders();
						}

						$this->mail->Subject = 'Регистрация на PandaTravel';
						$this->mail->Body = 'На сайте PandaTravel.com.ua зарегистрировался новый пользователь <a href="'.PROJECT_URL.'admin/users.edit.php?intUserID='.$data['intUserID'].'">'.$data['varName'].'</a> ';
						$this->mail->From = PROJECT_FROM_MAIL;
						$this->mail->FromName = 'Admin PandaTravel';
						$this->mail->ContentType = 'text/html';
						$this->mail->AddAddress(PROJECT_TO_MAIL);
						$this->mail->AddCustomHeader('MIME-Version: 1.0' . "\n");
						$this->mail->CharSet = 'utf-8';
						$this->mail->Send();
						$this->mail->ClearAddresses();
						$this->mail->ClearAttachments();
						$this->mail->ClearCustomHeaders();

					$this->addMessage('Спасибо за регистрацию.<br /><br />На Ваш e-mail прийдёт подтверждение регистрации.');
					$this->response->redirect('/');
				}
			}
		//}
	}

	function OnUpdate() {

		$data['varUser'] = $this->session->Get('varUser');

		$data['intPersonID'] = $_SESSION['varUserData']['intPersonID'];
		$data['varPassword'] = $this->request->getString('varPassword');
		$data['varName'] = $this->request->getString('varName');
		$data['varOwnership'] = $this->request->getString('varOwnership');
		$data['varTaxID'] = $this->request->getString('varTaxID');
		$data['varVatID'] = $this->request->getString('varVatID');
		$data['varPhone'] = $this->request->getString('varPhone');
		$data['varFax'] = $this->request->getString('varFax');
		$data['varEmail'] = $this->request->getString('varEmail');
		$data['varLegalAddressZip'] = $this->request->getString('varLegalAddressZip');
		$data['varLegalAddress'] = $this->request->getString('varLegalAddress');
		$data['varFactAddressZip'] = $this->request->getString('varFactAddressZip');
		$data['varFactAddress'] = $this->request->getString('varFactAddress');
		$data['varPostalAddressZip'] = $this->request->getString('varPostalAddressZip');
		$data['varPostalAddress'] = $this->request->getString('varPostalAddress');
		$data['varHeadName'] = $this->request->getString('varHeadName');
		$data['varHeadPosition'] = $this->request->getString('varHeadPosition');
		$data['varHeadGround'] = $this->request->getString('varHeadGround');
		$data['varBankAccount'] = $this->request->getString('varBankAccount');
		$data['varBankCode'] = $this->request->getString('varBankCode');

		$data['varFIO'] = $this->request->getString('varFIO');
		$data['varFirstName'] = $this->request->getString('varFirstName');
		$data['varLastName'] = $this->request->getString('varLastName');
		$data['varBirthDate'] = $this->request->getString('varBirthDate');
		$data['varSex'] = $this->request->getString('varSex');
		$data['varCitizenship'] = $this->request->getString('varCitizenship');
		$data['varTaxID'] = $this->request->getString('varTaxID');

		$data['NAT_PASSPORT']['intPassOrSvidet'] = $this->request->getString('NAT_PASSPORT');
		
		$data['NEW_PASSPORT'] = $this->request->getString('NEW_PASSPORT');


		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->document->addValue('registerFailed', 'Исправьте ошибки заполнения формы');
		}
		else {
			$new = api::getInstance()->UpdateUser($data);
			if(substr(json_decode($new)->code,0,1)==3) {
				$res = api::getInstance()->GetUser($_SESSION['varUser']);
				$_SESSION['varUserData'] = (array)json_decode($res)->data;
				$this->document->addValue('registerSuccess', 'Данные изменены.');
			}
		}

	}

		function OnForgot() {
			$data['varEmail'] = $this->request->getString('varEmail', 'NotEmpty');

			if ($this->request->getErrors()) {
				$this->data = $data;
				$this->document->addValue('message', 'Введите Email');
			} else {
				$isusedmail = $this->usersTable->GetByFields(array('varEmail'=>$data['varEmail']));

				if(!$isusedmail) {
					$this->addErrorMessage('Такого Email не существует');
				} else {

					$tmpdata['varPassword'] = substr(md5(time()),0,6);
					$tmpdata['intUserID'] = $isusedmail['intUserID'];

					$this->usersTable->Update($tmpdata);

					$this->mail->Subject = 'Напоминание пароля на PandaTravel';
					$this->mail->Body = 'Ваш новый пароль: '.$tmpdata['varPassword'];
					$this->mail->From = PROJECT_FROM_MAIL;
					$this->mail->FromName = 'Admin PandaTravel';
					$this->mail->ContentType = 'text/html';
					$this->mail->AddAddress($data['varEmail']);
					$this->mail->AddCustomHeader('MIME-Version: 1.0' . "\n");
					$this->mail->CharSet = 'utf-8';
					$this->mail->Send();

					$this->addMessage('На Ваш Email отправлен новый пароль');
					$this->response->redirect('/');
				}
			}
		}

		function OnExit() {
			$this->OnLogout();	
		}
		
		function render() {
			parent::render();



			$this->document->addValue('data', $this->data);
		}

	}

	Kernel::ProcessPage(new IndexPage("enter.tpl"));