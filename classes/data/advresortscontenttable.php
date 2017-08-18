<?php

Kernel::Import("system.db.abstracttable");

class AdvResortsContentTable extends AbstractTable {

	function AdvResortsContentTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_ADV_RESORTS_CONTENT);
		$this->addTableField('intResortContentID', DB_COLUMN_NUMERIC, true);
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
	
	public function getListIDsUrl() {
		$SQL = sprintf('SELECT intResortContentID as identificator, varUrlAlias
						FROM %s;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
}