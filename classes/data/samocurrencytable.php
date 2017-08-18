<?php

Kernel::Import("system.db.mssqlabstracttable");

class NowCurrateTable extends MSSQlAbstractTable {

	function NowCurrateTable(&$connection) {
		parent::MSSQlAbstractTable($connection, DB_TABLE_NOWCURRATE);
		
		$this->addTableField('inc', DB_COLUMN_NUMERIC, true);
		$this->addTableField('curr_from');
		$this->addTableField('curr_to');
		$this->addTableField('rate');
		$this->addTableField('alias_from');
		$this->addTableField('alias_to');
	}
	
}