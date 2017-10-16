<?php

Kernel::Import("system.db.abstracttable");

class HotelsServicesParamsTable extends AbstractTable {

	function HotelsServicesParamsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_HOTELS_SERVICES_PARAMS);
		
		$this->addTableField('intParamID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intGroupID', DB_COLUMN_NUMERIC);
		$this->addTableField('varParamType');
		$this->addTableField('varTitle');
		$this->addTableField('varTitle2');
		$this->addTableField('varText');
		$this->addTableField('intSortOrder', DB_COLUMN_NUMERIC);
	}
	
}