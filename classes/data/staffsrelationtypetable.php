<?php

Kernel::Import("system.db.abstracttable");

class StaffsRelationTypeTable extends AbstractTable {

	function StaffsRelationTypeTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_STAFFS_RELATION_TYPE);
		$this->addTableField('intRelationID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intStaffID', DB_COLUMN_NUMERIC); 
		$this->addTableField('intTypeID', DB_COLUMN_NUMERIC);
	}
}
