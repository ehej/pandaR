<?php

Kernel::Import("system.db.abstracttable");

class AttractionsTable extends AbstractTable {

	function AttractionsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_ATTRACTIONS);
		$this->addTableField('intAttractionID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intCountryID', DB_COLUMN_NUMERIC);
		$this->addTableField('intResortID', DB_COLUMN_NUMERIC);
		$this->addTableField('varName');
		$this->addTableField('varContent');
		$this->addTableField('varUrlAlias');
		$this->addTableField('varPageTitle');
		$this->addTableField('varPageDescription');
		$this->addTableField('varPageKeywords');
		$this->addTableField('varH1Text');
		$this->addTableField('intOrdering', DB_COLUMN_NUMERIC);
		$this->addTableField('isActive');
	}
	
	public function getIDAttr($val) {
		$SQL = sprintf('
			SELECT intAttractionID 
			FROM %s  
			WHERE  intCountryID = "'.$val.'"  
			ORDER BY varName', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
	
	public function getListIDsUrl() {
		$SQL = sprintf('SELECT intAttractionID as identificator, varUrlAlias
						FROM %s;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
}