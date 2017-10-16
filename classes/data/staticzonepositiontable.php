<?php

Kernel::Import("system.db.abstracttable");

class StaticZonePositionTable extends AbstractTable {

	function StaticZonePositionTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_STATIC_ZONE_POSITION);
		$this->addTableField('intPositionID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varPosition');
		$this->addTableField('varNamePosition');
	}
}
