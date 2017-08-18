<?php

Kernel::Import("system.db.abstracttable");

class NewsTypeTable extends AbstractTable {

	function NewsTypeTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_NEWS_TYPE);
		$this->addTableField('intNewsTypeID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varNameType');
		$this->addTableField('varUrlAlias');
		$this->addTableField('intOrdering', DB_COLUMN_NUMERIC);
		$this->addTableField('isActive');
	}
	
	public function getListIDsUrl() {
		$SQL = sprintf('SELECT intNewsTypeID as identificator, varUrlAlias
						FROM %s;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
}