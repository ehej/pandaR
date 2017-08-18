<?php

Kernel::Import("system.db.abstracttable");

class StaffsTable extends AbstractTable {

	function StaffsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_STAFFS);
		$this->addTableField('intStaffID', DB_COLUMN_NUMERIC, true); 
		$this->addTableField('intTypeID', DB_COLUMN_NUMERIC); 	
		$this->addTableField('varName'); 	
		$this->addTableField('varView');
		$this->addTableField('varFoto');
		$this->addTableField('varPost');
		$this->addTableField('varInfo');
	}
}
