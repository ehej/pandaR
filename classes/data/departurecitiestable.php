<?php

Kernel::Import("system.db.abstracttable");

class DepartureCitiesTable extends AbstractTable {

	function DepartureCitiesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_DEPARTURE_CITIES);
		
		$this->addTableField('intDepadtureCityID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intRegionID', DB_COLUMN_NUMERIC);	
		$this->addTableField('varName');
		$this->addTableField('intMTRegionID', DB_COLUMN_NUMERIC);
	}
	
}