<?php

Kernel::Import("system.db.abstracttable");

class HotelsServicesGroupsTable extends AbstractTable {

	function HotelsServicesGroupsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_HOTELS_SERVICES_GROUPS);
		
		$this->addTableField('intGroupID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varTitle');
		$this->addTableField('intSortOrder', DB_COLUMN_NUMERIC);
	}
	
}