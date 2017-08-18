<?php

Kernel::Import("system.db.mssqlabstracttable");

class TblCountryTable extends MSSQlAbstractTable {

	function TblCountryTable(&$connection) {
		parent::MSSQlAbstractTable($connection, DB_TABLE_TBL_COUNTRY);
		
		$this->addTableField('CN_KEY', DB_COLUMN_NUMERIC, true);
		$this->addTableField('CN_NAME');	
		$this->addTableField('CN_NAMELAT');		
		$this->addTableField('CN_FRAME', DB_COLUMN_NUMERIC);
		$this->addTableField('CN_WEB');	
		$this->addTableField('CN_WEBIMAGE');	
		$this->addTableField('CN_WEBHTTP');	
		$this->addTableField('CN_CODE');	
		$this->addTableField('ROWID');	
		$this->addTableField('CN_AnkLang', DB_COLUMN_NUMERIC);	
		$this->addTableField('CN_StdKey');	
		$this->addTableField('CN_Updatedate');	
		$this->addTableField('CN_SMALLDESC');
		$this->addTableField('CN_COKey', DB_COLUMN_NUMERIC);	
		$this->addTableField('CN_NameAC');	
		$this->addTableField('CN_Order', DB_COLUMN_NUMERIC);	
		$this->addTableField('CN_CitizenName');
		$this->addTableField('CN_CitizenNameLat');	
		$this->addTableField('CN_INNName');	
		$this->addTableField('CN_CheckINN');	
		$this->addTableField('CN_PassportMinDur', DB_COLUMN_NUMERIC);	
	}
	
}