<?php

Kernel::Import("system.db.abstracttable");

class PagesToCountriesTable extends AbstractTable {

	function PagesToCountriesTable (&$connection) {
		parent::AbstractTable($connection, DB_TABLE_PAGES_TO_COUNTRIES);
		
		$this->addTableField('intPageToCountryID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intPageID', DB_COLUMN_NUMERIC);
		$this->addTableField('intCountryID', DB_COLUMN_NUMERIC);
	}
}