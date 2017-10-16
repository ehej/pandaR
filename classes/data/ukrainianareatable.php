<?php

Kernel::Import("system.db.abstracttable");

class UkrainianAreaTable extends AbstractTable {

	function UkrainianAreaTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_UKRAINE_AREA);
		
		$this->addTableField('intAreaID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varName');
		$this->addTableField('isActive', DB_COLUMN_NUMERIC);
	}
}