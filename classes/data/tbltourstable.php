<?php

Kernel::Import("system.db.mssqlabstracttable");

class TblToursTable extends MSSQlAbstractTable {

	function TblToursTable(&$connection) {
		parent::MSSQlAbstractTable($connection, DB_TABLE_TBL_TOURS);
		
		$this->addTableField('TO_Key', DB_COLUMN_NUMERIC, true);
		$this->addTableField('TO_TRKey', DB_COLUMN_NUMERIC);	
		$this->addTableField('TO_Name');		
		$this->addTableField('TO_PRKey', DB_COLUMN_NUMERIC);
		$this->addTableField('TO_CNKey', DB_COLUMN_NUMERIC);	
		$this->addTableField('TO_Rate');	
		$this->addTableField('TO_DateCreated');	
		$this->addTableField('TO_DateValid');	
		$this->addTableField('TO_PriceFor', DB_COLUMN_NUMERIC);	
		$this->addTableField('TO_OpKey', DB_COLUMN_NUMERIC);	
		$this->addTableField('TO_XML');	
		$this->addTableField('TO_DateBegin');	
		$this->addTableField('TO_DateEnd');
		$this->addTableField('TO_IsEnabled', DB_COLUMN_NUMERIC);	
		$this->addTableField('TO_PROGRESS', DB_COLUMN_NUMERIC);	
		$this->addTableField('TO_UPDATE', DB_COLUMN_NUMERIC);
		$this->addTableField('TO_UPDATETIME');
		$this->addTableField('TO_DateValidBegin');
		$this->addTableField('TO_CalculateDateEnd');
		$this->addTableField('TO_PriceCount', DB_COLUMN_NUMERIC);
		$this->addTableField('to_attribute', DB_COLUMN_NUMERIC);
		$this->addTableField('TO_MinPrice');
		$this->addTableField('TO_HotelNights');
	}
	
}