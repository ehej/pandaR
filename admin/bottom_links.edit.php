<?php

include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.BottomLinksTable");

class IndexPage extends AdminPage {

	/**
	 * @var BottomLinksTable
	 */
	var $bottomLinksTable;
	
	var $data = false;

	function index() {
		parent::index();
		$this->setPageTitle('Ссылка');
		$this->setBoldMenu('bottomLinks');

		$this->bottomLinksTable = new BottomLinksTable($this->connection);
		
		$intBottomLinkID = $this->request->getNumber('intBottomLinkID', 0);
		if ($intBottomLinkID) {
			$this->data = $this->bottomLinksTable->Get(array('intBottomLinkID' => $intBottomLinkID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет ссылки с заданным ID');
				$this->response->redirect('index.php');
			}
		}
	}

	function OnSave() {		
		$data['intBottomLinkID'] = $this->request->getNumber('intBottomLinkID');
		$data['varTitle'] = $this->request->getString('varTitle', 'NotEmpty');
		$data['varURL'] = $this->request->getString('varURL', 'NotEmpty');

		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {
			if (isset($data['intBottomLinkID']) && !empty($data['intBottomLinkID'])) {
				$this->bottomLinksTable->Update($data);
			} else {
				$this->bottomLinksTable->Insert($data);
			}

			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intBottomLinkID']) && !empty($data['intBottomLinkID'])) $this->response->redirect('bottom_links.edit.php?intBottomLinkID='.$data['intBottomLinkID']);
		}
	}

	function render() {
		parent::render();
		
		$this->document->addValue('data', $this->data);
	}

	function getMenuTree($intMenuID = 0) {
		$sort = array('intSortOrder'=>'asc');
		$data = array('intParentID'=>0);
		$menu_list = $this->menuCountriesTable->GetList($data, $sort);
		if (is_array($menu_list)) {
			foreach($menu_list as $k => $v) {
				if($v['intMenuID'] == $intMenuID) {
					unset($menu_list[$k]);
					continue;
				}
			}
		}
		return $menu_list;
	}
}

Kernel::ProcessPage(new IndexPage("bottom_links.edit.tpl"));