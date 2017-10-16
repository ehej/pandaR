<?php

Kernel::Import("system.db.abstracttable");

class CountriesToWhereBuyTable extends AbstractTable {

	function CountriesToWhereBuyTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_COUNTRIES_TO_WHERE_BUY);
		
		$this->addTableField('intCtWbID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intCountryID', DB_COLUMN_NUMERIC);
		$this->addTableField('intWhereBuyID', DB_COLUMN_NUMERIC);
	}

}