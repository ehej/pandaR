<?php
include_once(dirname(__FILE__)."/../classes/variables.php");
Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.MessagesTable");
Kernel::Import("classes.data.SubscribesTable");
Kernel::Import("classes.unit.phpmailer.phpmailer");

class IndexPage extends AdminPage {

	var $messagesTable;	
	var $data = false;
	var $intMessageID;
	var $mail;
	
	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных статьи для рассылки');
		$this->setBoldMenu('messages');
		$this->mail = new PHPMailer();
		
		$this->messagesTable = new MessagesTable($this->connection);		
		$this->intMessageID = $this->request->getNumber('intMessageID', 0);
		if ($this->intMessageID) {
			$this->data = $this->messagesTable->Get(array('intMessageID'=>$this->intMessageID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет страницы с заданным ID');
				$this->response->redirect('messages.php');
			}
		}
	}
	
	function OnSend() {
		if ($this->intMessageID) {
			$subscribesTable = new SubscribesTable($this->connection);
			$subscribes = $subscribesTable->getList(array('isActive'=>1));
			if ( ! empty($subscribes)) {
				foreach($subscribes as $k => $subscribe) {
					$this->mail->Subject = $this->data['varSubject'];
					$this->mail->Body = $this->data['varMessage'];
					$this->mail->From = PROJECT_FROM_MAIL;
					$this->mail->FromName = 'Служба рассылки Week-End';
					$this->mail->ContentType = 'text/html';
					$this->mail->AddAddress($subscribe['varEmail']);
					$this->mail->AddCustomHeader('MIME-Version: 1.0' . "\n");
					$this->mail->CharSet = 'utf-8';
					
					if($this->data['varFile1']) {
						$this->mail->AddAttachment(FILESTORAGE_PATH.'files/'.$this->data['varFile1'], $this->data['varRealFile1Name']);
					}
					if($this->data['varFile2']) {
						$this->mail->AddAttachment(FILESTORAGE_PATH.'files/'.$this->data['varFile2'], $this->data['varRealFile2Name']);
					}
					if($this->data['varFile3']) {
						$this->mail->AddAttachment(FILESTORAGE_PATH.'files/'.$this->data['varFile3'], $this->data['varRealFile3Name']);
					}
					
					if(!$this->mail->Send()) {
						$this->addErrorMessage('Не удалось отправить письмо на <'.$subscribe['varEmail'].'>');
					} else {						
						$this->mail->ClearAddresses();
						$this->mail->ClearAttachments();
						$this->mail->ClearCustomHeaders();
					}
				}
			}
			$this->data['varDate'] = date("Y-m-d H:i:s");
			$this->messagesTable->update($this->data);
			$this->addMessage('Статья c темой "'.$this->data['varSubject'].'" успешно разослала');
		} else {
			$this->addErrorMessage('Нет страницы для рассылки');
		}	
		
		$this->response->redirect('messages.php');
		
	}

	function OnDeleteFile() {
		$data['intMessageID'] = $this->request->getNumber('intMessageID', 'NotEmpty');
		$data['varFile'] =	$this->request->getString('varFile', 'NotEmpty');	
		$data['intFilePos'] = $this->request->getNumber('intFilePos', 'NotEmpty');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки');
		} else {
			if (!empty($this->data['varFile'.$data['intFilePos']])) {
				unlink(FILES_PATH.$this->data['varFile'.$data['intFilePos']]);
				$this->data['varFile'.$data['intFilePos']] = '';
				$this->data['varRealFile'.$data['intFilePos'].'Name'] = '';
				$this->messagesTable->update($this->data);
			}
		}
	}
	
 	function OnSave() {
		$data['intMessageID'] = $this->request->getNumber('intMessageID');
		$data['varSubject'] =	$this->request->getString('varSubject', 'NotEmpty');
		$data['varMessage'] = $this->request->getString('varMessage', 'NotEmpty');
		$data['varFile1'] = $this->request->getFiles('varFile1');
		$data['varFile2'] = $this->request->getFiles('varFile2');
		$data['varFile3'] = $this->request->getFiles('varFile3');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if ($data['varFile1']['size']) {
				$data['varRealFile1Name'] = $data['varFile1']['name'];
				if (!empty($this->data['varFile1'])) unlink(FILES_PATH.$this->data['varFile1']);
				$file_pathinfo = pathinfo($data['varFile1']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varFile1']['tmp_name'], FILES_PATH.$file_name);
				chmod(FILES_PATH.$file_name, 0777);
				$data['varFile1'] = $file_name;
			} else $data['varFile1'] = $this->data['varFile1'];
			
			if ($data['varFile2']['size']) {
				$data['varRealFile2Name'] = $data['varFile2']['name'];
				if (!empty($this->data['varFile2'])) unlink(FILES_PATH.$this->data['varFile2']);
				$file_pathinfo = pathinfo($data['varFile2']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varFile2']['tmp_name'], FILES_PATH.$file_name);
				chmod(FILES_PATH.$file_name, 0777);
				$data['varFile2'] = $file_name;				
			} else $data['varFile2'] = $this->data['varFile2'];
			
			if ($data['varFile3']['size']) {
				$data['varRealFile3Name'] = $data['varFile3']['name'];
				if (!empty($this->data['varFile3'])) unlink(FILES_PATH.$this->data['varFile3']);
				$file_pathinfo = pathinfo($data['varFile3']['name']);
				$file_name = md5($file_pathinfo['basename'].time()).'.'.$file_pathinfo['extension'];
				move_uploaded_file($data['varFile3']['tmp_name'], FILES_PATH.$file_name);
				chmod(FILES_PATH.$file_name, 0777);
				$data['varFile3'] = $file_name;			
			} else $data['varFile3'] = $this->data['varFile3'];		
			
			$data['varMessage'] = str_replace('href="/data/filestorage/', 'href="'.PROJECT_URL.'data/filestorage/', $data['varMessage']);
			
			if (isset($data['intMessageID']) && !empty($data['intMessageID'])) {
				$this->messagesTable->Update($data);
			} else {
				$this->messagesTable->Insert($data);
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intMessageID']) && !empty($data['intMessageID'])) $this->response->redirect('messages.edit.php?intMessageID='.$data['intMessageID']);
		}
	}

	function render() {
		parent::render();
		
		$this->document->addValue('FILES_URL', FILES_URL);
		$this->document->addValue('data', $this->data);		
	}

}

Kernel::ProcessPage(new IndexPage("messages.edit.tpl"));