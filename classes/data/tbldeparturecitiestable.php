<?php

Kernel::Import("system.db.mssqlabstracttable");

class TblDepartureCitiesTable extends MSSQlAbstractTable {

	function TblDepartureCitiesTable(&$connection) {
		parent::MSSQlAbstractTable($connection, DB_TABLE_TBL_DEPARTURE_CITIES);
		
		$this->addTableField('ap_key', DB_COLUMN_NUMERIC, true);
		$this->addTableField('AP_CTKEY', DB_COLUMN_NUMERIC); // id региона
		$this->addTableField('AP_CODE');
		$this->addTableField('AP_NAME');	
		$this->addTableField('AP_LETTER');	
		$this->addTableField('AP_SITE');	
		$this->addTableField('ROWID');	
		$this->addTableField('AP_StdKey');	
		$this->addTableField('AP_NameLat');		
	}
	
}