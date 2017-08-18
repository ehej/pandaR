<?php

include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

Kernel::Import("classes.web.AdminPage");
Kernel::Import("classes.data.CurrenciesTable");
Kernel::Import("classes.data.Currencies_ArchiveTable");

class IndexPage extends AdminPage {

	/**
	 * @var RolesTable
	 */
	var $rolesTable;
	/**
	 * @var UsersTable
	 */
	var $usersTable;

	var $page = 1;
	var $sfilter = array();

	function index() {
		parent::index();
		
		$this->setPageTitle('Курс');
		$this->setBoldMenu('currencies');

		
		$this->currenciesTable = new CurrenciesTable($this->connection);
		$this->currenciesarchiveTable = new CurrenciesArchiveTable($this->connection);

		$this->data = $this->currenciesTable->getList();
		$this->archive = $this->currenciesarchiveTable->GetList(null, array('intArchiveID'=>'DESC'));
	}

	function OnDelete() {
		$id = $this->request->getnumber('intArchiveID');
		$data = array('intArchiveID'=>$id);
		$this->currenciesarchiveTable->delete($data);
		$this->response->redirect('currencies.php');
	}

	function OnSave() {
		$names = $this->request->value('varName');
		$marks = $this->request->value('varMark');
		$rates = $this->request->value('intRate');
		$date = $this->request->getDate('varDate');

		$nextarchID = $this->archive[0]['intArchiveID'];
		$nextarchID++;

		foreach($this->data as $value) {
			$data = array(
				'intArchiveID'=>$nextarchID,
				'intCurrencyID'=>$value['intCurrencyID'],
				'intRate'=>$value['intRate'],
				'varDate'=>$value['varDate']
			);
			$this->currenciesarchiveTable->insert($data, true);
		}

		foreach($names as $key=>$data) {
			$data = array(
				'intCurrencyID'=>$key,
				'varName'=>$names[$key],
				'varMark'=>$marks[$key],
				'intRate'=>$rates[$key],
				'varDate'=>$date
			);
			$this->currenciesTable->update($data);
		}

		$this->response->redirect('currencies.php');
	}

	function render() {
		parent::render();

		$this->document->addValue('roles', $this->data);
		$this->document->addValue('archive', $this->archive);
	}

}

Kernel::ProcessPage(new IndexPage("currencies.tpl"));