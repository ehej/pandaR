<?php

Kernel::Import("system.db.abstracttable");

class SpoPreferencesTable extends AbstractTable {

	function SpoPreferencesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_SPO_PREFERENCES);
		
		$this->addTableField('intSPOPrefID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varColorBG');
		$this->addTableField('varColorRO');
        $this->addTableField('varImgBGTop');
        $this->addTableField('varImgBGBody');
        $this->addTableField('varColorBGBody');
	}

}