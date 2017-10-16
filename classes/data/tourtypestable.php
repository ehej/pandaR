<?php

Kernel::Import("system.db.abstracttable");

class TourTypesTable extends AbstractTable {

	function TourTypesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_TOURTYPES);
		
		$this->addTableField('intTypeID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varName');
		$this->addTableField('varLogo');		
		$this->addTableField('varRealLogoName');
		$this->addTableField('intSortOrder', DB_COLUMN_NUMERIC);
		$this->addTableField('intActive', DB_COLUMN_NUMERIC);
	}
	
}