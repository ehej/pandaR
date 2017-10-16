<?php

Kernel::Import("system.db.abstracttable");

class PreferencesTable extends AbstractTable {

	function PreferencesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_PREFERENCES);
		
		$this->addTableField('intPrefID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varPrefName');
		$this->addTableField('varPrefValue');
		$this->addTableField('varPrefDescr'); 
		$this->addTableField('varDate');
	}

}