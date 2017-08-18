<?php
include_once(dirname(__FILE__)."/../classes/variables.php");

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.PromotionsTypesTable");

class IndexPage extends AdminPage {

	/**
	 * @var PromotionsTypesTable
	 */
	var $promotionsTypesTable;
		
	var $data = false;
	var $intPromotionTypeID;

	function index() {
		parent::index();
		
		$this->setPageTitle('Редактирование данных типа спецпредложения');
		$this->setBoldMenu('promotionstypes');	
			
		$this->promotionsTypesTable = new PromotionsTypesTable($this->connection);	
			
		$this->intPromotionTypeID = $this->request->getNumber('intPromotionTypeID', 0);
		if ($this->intPromotionTypeID) {
			$this->data = $this->promotionsTypesTable->Get(array('intPromotionTypeID' => $this->intPromotionTypeID));
			if (empty($this->data)) {
				$this->addErrorMessage('Нет типа спецпредложения с заданным ID');
				$this->response->redirect('promotionstypes.php');
			}
		}
	}
		
 	function OnSave() {
		$data['intPromotionTypeID'] = $this->request->getNumber('intPromotionTypeID');
		$data['varName'] =	$this->request->getString('varName', 'NotEmpty');
		$data['varColapse'] =	$this->request->getString('varColapse', null, 'N');
		
		if ($this->request->getErrors()) {
			$this->data = $data;
			$this->addErrorMessage('Исправьте ошибки заполнения формы');
		} else {			
			if (!empty($data['intPromotionTypeID'])) {
				$this->promotionsTypesTable->Update($data);
			} else {
				$this->promotionsTypesTable->Insert($data);
			}
			$this->addMessage('Данные успешно сохранены');
			if (isset($data['intPromotionTypeID']) && !empty($data['intPromotionTypeID'])) $this->response->redirect('promotionstypes.edit.php?intPromotionTypeID='.$data['intPromotionTypeID']);
		}
	}
	
	function render() {
		parent::render();
		
		$this->document->addValue('data', $this->data);		
	}

}

Kernel::ProcessPage(new IndexPage("promotionstypes.edit.tpl"));