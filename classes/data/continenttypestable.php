<?php

Kernel::Import("system.db.abstracttable");

class ContinentTypesTable extends AbstractTable {

	function ContinentTypesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_CONTINENTTYPES);
		
		$this->addTableField('intTypeID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varName');
		$this->addTableField('varLogo');		
		$this->addTableField('varRealLogoName');
		$this->addTableField('intSortOrder', DB_COLUMN_NUMERIC);
	}
	
}