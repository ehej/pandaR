<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.LinksTable");

class IndexPage extends AdminPage {

	/**
	 * @var LinksTable
	 */
	var $LinksTable;	
	
	var $data = false;

	function index() {
		parent::index();
		$this->setPageTitle('Редактирование ссылок блока слева');
		$this->setBoldMenu('links');		
		
		$this->LinksTable = new LinksTable($this->connection);

		$this->data = $this->LinksTable->GetList();
	}
		
 	function OnSave() {
		$links = $this->request->Value('links');
		var_dump($data);
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			
			foreach($links as $key => $val) {
				$val['intActive'] = $val['intActive']?1:0;
				$this->LinksTable->Update($val);
			}

			$this->addMessage('Данные успешно сохранены');
		}
		
		$this->response->redirect('links.php');
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('data', $this->data);		
	}

}

Kernel::ProcessPage(new IndexPage("links.tpl"));