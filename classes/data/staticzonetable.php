<?php

Kernel::Import("system.db.abstracttable");

class StaticZoneTable extends AbstractTable {

	function StaticZoneTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_STATIC_ZONE);
		$this->addTableField('intSZID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varPosition');
		$this->addTableField('intOrdering', DB_COLUMN_NUMERIC);
		$this->addTableField('varText');
		$this->addTableField('isActive', DB_COLUMN_NUMERIC);
	}
}
