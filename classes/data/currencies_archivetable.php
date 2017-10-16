<?php

Kernel::Import("system.db.abstracttable");

class CurrenciesArchiveTable extends AbstractTable {

	function CurrenciesArchiveTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_CURRENCIES_ARCHIVE);
		
		$this->addTableField('intArchiveID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intCurrencyID', DB_COLUMN_NUMERIC);
		$this->addTableField('intRate');
		$this->addTableField('varDate');

	}

}