<?php

Kernel::Import("system.db.abstracttable");

class CategoryInfoTable extends AbstractTable {

	function CategoryInfoTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_CATEGORY_INFO);
		$this->addTableField('intCategoryID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varName');
		$this->addTableField('intOrdering', DB_COLUMN_NUMERIC);
		$this->addTableField('isActive');
		$this->addTableField('isAllwaysOpen', DB_COLUMN_NUMERIC);
	}
	
	public function getListIDsUrl() {
		$SQL = sprintf('SELECT intNewsTypeID as identificator, varUrlAlias
						FROM %s;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
}