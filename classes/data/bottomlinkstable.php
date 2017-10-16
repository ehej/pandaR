<?php

Kernel::Import("system.db.abstracttable");

class BottomLinksTable extends AbstractTable {

	function BottomLinksTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_BOTTOM_LINKS);
		
		$this->addTableField('intBottomLinkID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varTitle');
		$this->addTableField('varURL');
		$this->addTableField('intSortOrder', DB_COLUMN_NUMERIC);
	}
	
}