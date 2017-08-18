<?php

Kernel::Import("system.db.mssqlabstracttable");

class TblRegionTable extends MSSQlAbstractTable {

	function TblRegionTable(&$connection) {
		parent::MSSQlAbstractTable($connection, DB_TABLE_TBL_REGION);
		
		$this->addTableField('CT_KEY', DB_COLUMN_NUMERIC, true);
		$this->addTableField('CT_CNKEY', DB_COLUMN_NUMERIC);	
		$this->addTableField('CT_NAME');		
		$this->addTableField('CT_NAMELAT');
		$this->addTableField('CT_CODE');	
		$this->addTableField('CT_CREATOR', DB_COLUMN_NUMERIC);	
		$this->addTableField('CT_UPDATEDATE');	
		$this->addTableField('ROWID');	
		$this->addTableField('CT_StdKey');	
		$this->addTableField('CT_NameAC');	
		$this->addTableField('CT_Web');	
		$this->addTableField('CT_RSKey');	
		$this->addTableField('CT_WEBIMAGE');
		$this->addTableField('CT_Order', DB_COLUMN_NUMERIC);	
		$this->addTableField('CT_IsDeparture', DB_COLUMN_NUMERIC);	
		$this->addTableField('CT_Coordinate');
	}
	
}