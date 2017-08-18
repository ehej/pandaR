<?php

Kernel::Import("system.db.abstracttable");

class MenuTable extends AbstractTable {

	function MenuTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_MENU);
		
		$this->addTableField('intMenuID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varTitle');
		$this->addTableField('varModule');
		$this->addTableField('varUrl');
		$this->addTableField('varIdentifier');
		$this->addTableField('intParentID', DB_COLUMN_NUMERIC);
		$this->addTableField('varTypeMenu');
		$this->addTableField('intSortOrder', DB_COLUMN_NUMERIC);
		$this->addTableField('isAuthorized', DB_COLUMN_NUMERIC);
		$this->addTableField('isVisible', DB_COLUMN_NUMERIC);
		$this->addTableField('varImage');
	}
	
}