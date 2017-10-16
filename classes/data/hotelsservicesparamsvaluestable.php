<?php

Kernel::Import("system.db.abstracttable");

class HotelsServicesParamsValuesTable extends AbstractTable {

	function HotelsServicesParamsValues(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_HOTELS_SERVICES_PARAMS_VALUES);
		
		$this->addTableField('intHotelID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intParamID', DB_COLUMN_NUMERIC);
		$this->addTableField('varParamValue');
	}
	
}