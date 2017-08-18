<?php

Kernel::Import("system.db.mssqlabstracttable");

class TblTurServicesTable extends MSSQlAbstractTable {

	function TblTurServicesTable(&$connection) {
		parent::MSSQlAbstractTable($connection, DB_TABLE_TUR_SERVICE);
		
		$this->addTableField('TS_TRKEY', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_SVKEY', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_PKKEY', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_NAME');
		$this->addTableField('TS_DAY', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_CODE', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_SUBCODE1', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_SUBCODE2', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_NDAYS', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_CNKEY', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_CTKEY', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_PARTNERKEY', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_COST');
		$this->addTableField('TS_PROFIT');
		$this->addTableField('TS_TIMEBEG');
		$this->addTableField('TS_ATTRIBUTE', DB_COLUMN_NUMERIC);
		$this->addTableField('ROWID');
		$this->addTableField('TS_Key', DB_COLUMN_NUMERIC, true);
		$this->addTableField('TS_NameLat');
		$this->addTableField('TS_PRTDOGKEY', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_TAXZONEID', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_WebAttribute', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_Wait', DB_COLUMN_NUMERIC);
	}
	
}