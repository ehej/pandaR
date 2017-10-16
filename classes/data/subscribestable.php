<?php
Kernel::Import("system.db.abstracttable");

class SubscribesTable extends AbstractTable {

	function SubscribesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_SUBSCRIBES);
		$this->addTableField('intSubscribeID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varEmail');
		$this->addTableField('varName');	
		$this->addTableField('varPhone');
		$this->addTableField('varCountry');
		$this->addTableField('varCompany');
		$this->addTableField('varPost');
		$this->addTableField('varHash');
		$this->addTableField('isActive', DB_COLUMN_NUMERIC);
		$this->addTableField('varDateAdd');
	}	
}