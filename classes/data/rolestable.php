<?php

Kernel::Import("system.db.abstracttable");

class RolesTable extends AbstractTable {

	function RolesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_ROLES);
		
		$this->addTableField('intRoleID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varRoleName');
		$this->addTableField('varPriveleges');
	}
	
}