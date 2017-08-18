<?php

Kernel::Import("system.db.abstracttable");

class AdvResortsTable extends AbstractTable {

	function AdvResortsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_ADV_RESORTS);		
		
		$this->addTableField('intResortID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intCountryID', DB_COLUMN_NUMERIC);
		$this->addTableField('varName');
		$this->addTableField('varContent');
	    $this->addTableField('varUrlAlias');
		$this->addTableField('varPageTitle');
		$this->addTableField('varPageDescription');
		$this->addTableField('varPageKeywords');
		$this->addTableField('varH1Text');
		$this->addTableField('intOrdering', DB_COLUMN_NUMERIC);
		$this->addTableField('intTypeBlock', DB_COLUMN_NUMERIC);
		$this->addTableField('isActive');
	}
	public function getListIDsNames() {
		$SQL = sprintf('SELECT intResortID, intCountryID, varName
						FROM %s;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
	
	public function getListIDsUrl() {
		$SQL = sprintf('SELECT intResortID as identificator, varUrlAlias
						FROM %s;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
}