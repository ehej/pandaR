<?php

Kernel::Import("system.db.abstracttable");

class OtherInfoTable extends AbstractTable {

	function OtherInfoTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_OTHER_INFO);
		$this->addTableField('intInfoID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intCountryID', DB_COLUMN_NUMERIC);
		$this->addTableField('intCategoryID', DB_COLUMN_NUMERIC);
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
		$SQL = sprintf('SELECT intInfoID as identificator, varUrlAlias
						FROM %s;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
}