<?php

Kernel::Import("system.db.abstracttable");

class AdminsTable extends AbstractTable {

	function AdminsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_ADMINS);
		$this->addTableField('intAdminID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varLogin');
		$this->addTableField('varPassword');
		$this->addTableField('varEmail');
		$this->addTableField('varFIO');
		$this->addTableField('varPhone');
		$this->addTableField('intRoleID', DB_COLUMN_NUMERIC);
		$this->addTableField('isActive', DB_COLUMN_NUMERIC);
	}

	function getAdminsName() {
		$SQL = sprintf("SELECT intAdminID, varName FROM %s", $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}

}
