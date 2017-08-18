<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.SettingsTable");

class IndexPage extends AdminPage {

	/**
	 * @var ContestsTable
	 */
	
	var $data = false;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование настроек сайта');
		$this->setBoldMenu('settings');
		
		$this->settingsTable = new SettingsTable($this->connection);
		
		$intSettingsID = $this->request->getNumber('intSettingsID', 0);
		if ($intSettingsID) {
			$this->data = $this->settingsTable->Get(array('intSettingsID' => $intSettingsID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет настроек с заданным ID');
				$this->response->redirect('/admin/');
			}
		}
	}

 	function OnSave() {
		$data['intSettingsID'] = $this->request->getNumber('intSettingsID');
		$data['intNewsAnnouncementCount'] =	$this->request->getString('intNewsAnnouncementCount', 'NotEmpty');
		$data['intNewsPageCount'] =	$this->request->getString('intNewsPageCount', 'NotEmpty');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if (isset($data['intSettingsID']) && !empty($data['intSettingsID'])) {
				$this->settingsTable->Update($data);
			} else {
				$this->settingsTable->Insert($data);
			}
			
			$intSettingsID = $data['intSettingsID'];
			
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intSettingsID']) && !empty($data['intSettingsID'])) $this->response->redirect('settings.edit.php?intSettingsID='.$data['intSettingsID']);
		}
	}

	function render() {
		parent::render();
		
		$this->document->addValue('data', $this->data);

	}

}

Kernel::ProcessPage(new IndexPage("settings.edit.tpl"));