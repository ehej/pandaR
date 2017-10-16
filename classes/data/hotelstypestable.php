<?php

Kernel::Import("system.db.abstracttable");

class HotelsTypesTable extends AbstractTable {

	function HotelsTypesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_HOTELS_TYPES);
		
		$this->addTableField('intHotelTypeID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varName');
	}
	
}