<?php

Kernel::Import("system.db.abstracttable");

class DocumentCategoryTable extends AbstractTable {

	function DocumentCategoryTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_DOCUMENT_CATEGORY);
		$this->addTableField('intCategoryID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varName');
		$this->addTableField('intOrdering');
	}
}