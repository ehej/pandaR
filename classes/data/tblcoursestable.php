<?php

Kernel::Import("system.db.mssqlabstracttable");

class TblCoursesTable extends MSSQlAbstractTable {

	function TblCoursesTable(&$connection) {
		parent::MSSQlAbstractTable($connection, DB_TABLE_TBL_COURSES);
		
		$this->addTableField('RC_Key', DB_COLUMN_NUMERIC, true);
		$this->addTableField('RC_RCOD1');	
		$this->addTableField('RC_COURSE');		
		$this->addTableField('RC_RCOD2');
		$this->addTableField('RC_DATEBEG');	
		$this->addTableField('RC_DATEEND');	
		$this->addTableField('ROWID');
		$this->addTableField('RC_COURSE_CB');
	}
	
}