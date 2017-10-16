<?php

Kernel::Import("system.db.mssqlabstracttable");

class TblHotelTable extends MSSQlAbstractTable {

	function TblHotelTable(&$connection) {
		parent::MSSQlAbstractTable($connection, DB_TABLE_TBL_HOTEL);
		
		$this->addTableField('HD_KEY', DB_COLUMN_NUMERIC, true);
		$this->addTableField('HD_CNKEY', DB_COLUMN_NUMERIC); // id страны	
		$this->addTableField('HD_CTKEY', DB_COLUMN_NUMERIC); // id региона	
		$this->addTableField('HD_NAME');
		$this->addTableField('HD_STARS');	
		$this->addTableField('HD_ADDRESS');	
		$this->addTableField('HD_PHONE');	
		$this->addTableField('HD_FAX');	
		$this->addTableField('HD_SITE');	
		$this->addTableField('HD_DESCRIPT');	
		$this->addTableField('HD_PERSONNAME');	
		$this->addTableField('HD_PERSONAPP');	
		$this->addTableField('HD_CODE');
		$this->addTableField('HD_RSKEY', DB_COLUMN_NUMERIC);	
		$this->addTableField('HD_EMAIL');	
		$this->addTableField('HD_HTTP');
		$this->addTableField('HD_DESCROOM');
		$this->addTableField('HD_DESCMEAL');
		$this->addTableField('HD_DESCSERVICE');
		$this->addTableField('HD_DESCSPORT');
		$this->addTableField('HD_DESCEXCUR');
		$this->addTableField('HD_DESCHEALTH');
		$this->addTableField('HD_DISTANCE');
		$this->addTableField('HD_WEB', DB_COLUMN_NUMERIC);
		$this->addTableField('HD_DESCRAZVL');
		$this->addTableField('HD_WEBIMAGE');
		$this->addTableField('HD_WEBIMAGE1');
		$this->addTableField('HD_WEBIMAGE2');
		$this->addTableField('HD_WEBIMAGE3');
		$this->addTableField('HD_WEBIMAGE4');
		$this->addTableField('HD_WEBIMAGE5');
		$this->addTableField('HD_WEBIMAGE6');
		$this->addTableField('HD_WEBIMAGE7');
		$this->addTableField('HD_WEBIMAGE8');
		$this->addTableField('HD_REMARK');
		$this->addTableField('HD_REMARK');
		$this->addTableField('HD_REMARK1');
		$this->addTableField('HD_REMARK2');
		$this->addTableField('HD_REMARK3');
		$this->addTableField('HD_REMARK4');
		$this->addTableField('HD_REMARK5');
		$this->addTableField('HD_REMARK6');
		$this->addTableField('HD_REMARK7');
		$this->addTableField('HD_REMARK8');
		$this->addTableField('ROWID');
		$this->addTableField('HD_StdKey');
		$this->addTableField('HD_UNICODE');
		$this->addTableField('HD_UPDATEDATE');
		$this->addTableField('HD_Order', DB_COLUMN_NUMERIC);
		$this->addTableField('HD_IsCruise', DB_COLUMN_NUMERIC);
		$this->addTableField('HD_COHId', DB_COLUMN_NUMERIC);
		$this->addTableField('HD_NAMELAT');
		$this->addTableField('HD_PayHour1');
		$this->addTableField('HD_PayHour2');
		$this->addTableField('HD_Travel');
		$this->addTableField('HD_PayHourNote');
		
	}
	
}