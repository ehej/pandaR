<?php

Kernel::Import("system.db.abstracttable");

class CurrenciesTable extends AbstractTable {

	function CurrenciesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_CURRENCIES);
		
		$this->addTableField('intCurrencyID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varName');
		$this->addTableField('intRate');
		$this->addTableField('varMark');
		$this->addTableField('varDate');

	}

}