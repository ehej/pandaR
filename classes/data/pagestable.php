<?php

Kernel::Import("system.db.abstracttable");

class PagesTable extends AbstractTable {

	function PagesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_PAGES);
		
		$this->addTableField('intPageID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varTitle');
		$this->addTableField('varUrlAlias');
		$this->addTableField('varAnnotation');
		$this->addTableField('varDescription');
		$this->addTableField('varMetaTitle');
		$this->addTableField('varMetaDescription');
		$this->addTableField('varMetaKeywords');
		$this->addTableField('intContestID', DB_COLUMN_NUMERIC);
		$this->addTableField('intActive', DB_COLUMN_NUMERIC);
		$this->addTableField('intOnlyAuthorized', DB_COLUMN_NUMERIC);
		$this->addTableField('varShowComments');
	}

	public function getReviews() {
		$SQL = sprintf("SELECT * FROM %s AS p WHERE p.intPageID = 9", $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}

	public function getExtNews()
	{
		$SQL = sprintf("SELECT * FROM %s AS p WHERE p.intPageID = 11", $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
	
	public function getListIDsUrl() {
		$SQL = sprintf('SELECT intPageID as identificator, varUrlAlias
						FROM %s;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
}