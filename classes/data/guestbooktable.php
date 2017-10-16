<?php

Kernel::Import("system.db.abstracttable");

class GuestBookTable extends AbstractTable {

	function GuestBookTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_GUEST_BOOK);
		
		$this->addTableField('intGBID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varName');
		$this->addTableField('varEmail');
		$this->addTableField('varSite');
		$this->addTableField('varText');
		$this->addTableField('varAnswer');
		$this->addTableField('varDate');
		$this->addTableField('intStatus', DB_COLUMN_NUMERIC);
	}
}
