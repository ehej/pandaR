<?php

Kernel::Import("system.db.abstracttable");

class UkrainianCityTable extends AbstractTable {

	function UkrainianCityTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_UKRAINE_CITY);
		
		$this->addTableField('intCityID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intAreaID', DB_COLUMN_NUMERIC);
		$this->addTableField('varName');
		$this->addTableField('isActive', DB_COLUMN_NUMERIC);
	}
}