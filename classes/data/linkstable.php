<?php
Kernel::Import("system.db.abstracttable");

class LinksTable extends AbstractTable {

	function LinksTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_LINKS);
		
		$this->addTableField('intLinkID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varName');
		$this->addTableField('varLink');
		$this->addTableField('intActive', DB_COLUMN_NUMERIC);
		$this->addTableField('varAliasClass');
	}
}