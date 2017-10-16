<?php

Kernel::Import("system.db.abstracttable");

class DocumentTable extends AbstractTable {

	function DocumentTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_DOCUMENT);
		
		$this->addTableField('intDocumentID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intCategoryID', DB_COLUMN_NUMERIC);
		$this->addTableField('varName');
		$this->addTableField('varDescription');
		$this->addTableField('varFile');
		$this->addTableField('varFileName');
		$this->addTableField('varFileNameReal');
		$this->addTableField('isActive', DB_COLUMN_NUMERIC);
		$this->addTableField('intOrdering', DB_COLUMN_NUMERIC);
		$this->addTableField('varDate');
	}
}