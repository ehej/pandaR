<?php
include_once(dirname(__FILE__)."/classes/variables.php");

Kernel::Import("classes.web.PublicPage");
Kernel::Import("classes.data.Currencies_ArchiveTable");
Kernel::Import("classes.data.CurrenciesTable");

class IndexPage extends PublicPage {

	
	function index() {
		parent::index();

		$this->currenciesarchiveTable = new CurrenciesArchiveTable($this->connection);

	}

	function render() {
		parent::render();

		$this->archive = $this->currenciesarchiveTable->GetList(null, array('intArchiveID'=>'DESC'),null,null,null,true,null,60);
		$this->document->addValue('archive', $this->archive);
	}
}

Kernel::ProcessPage(new IndexPage("exchangearchive.tpl"));