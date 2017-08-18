<?php

Kernel::Import("system.db.abstracttable");

class AdvCountriesTable extends AbstractTable {

	function AdvCountriesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_ADV_COUNTRIES);
		
		$this->addTableField('intCountryID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intParentCountry', DB_COLUMN_NUMERIC);
		$this->addTableField('varName');
		$this->addTableField('varDescription');
		$this->addTableField('varDescription2');
		$this->addTableField('varImage');
		$this->addTableField('varImageFlag');
		$this->addTableField('varImageMap');
		$this->addTableField('varUrlAlias');
		$this->addTableField('varPageTitle');
		$this->addTableField('varPageDescription');
		$this->addTableField('varPageKeywords');
		$this->addTableField('varH1Text');
		$this->addTableField('intOrdering', DB_COLUMN_NUMERIC);
		$this->addTableField('isActive');
	}
	
	public function getListIDsNames() {
		$SQL = sprintf('SELECT intCountryID, varName
						FROM %s ORDER BY varName;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
	public function getListIDsUrl() {
		$SQL = sprintf('SELECT intCountryID as identificator, varUrlAlias
						FROM %s;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
}
