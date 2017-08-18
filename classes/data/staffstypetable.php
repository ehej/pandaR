<?php

Kernel::Import("system.db.abstracttable");

class StaffsTypeTable extends AbstractTable {

	function StaffsTypeTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_STAFFS_TYPE);
		$this->addTableField('intTypeID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varNameType');
		$this->addTableField('intOrdering', DB_COLUMN_NUMERIC);
		$this->addTableField('isActive');
	}
	
	public function getListIDsUrl() {
		$SQL = sprintf('SELECT intTypeID as identificator, varUrlAlias
						FROM %s;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
}