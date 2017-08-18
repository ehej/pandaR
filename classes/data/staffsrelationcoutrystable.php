<?php

Kernel::Import("system.db.abstracttable");

class StaffsRelationCountryTable extends AbstractTable {

	function StaffsRelationCountryTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_STAFFS_RELATION_COUNTRY);
		$this->addTableField('intRelationID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intStaffID', DB_COLUMN_NUMERIC); 
		$this->addTableField('intCountry', DB_COLUMN_NUMERIC);
	}

}
