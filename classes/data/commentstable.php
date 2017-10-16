<?php

Kernel::Import("system.db.abstracttable");

class CommentsTable extends AbstractTable {

	function CommentsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_COMMENTS);
		
		$this->addTableField('intCommentID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varModuleName');
		$this->addTableField('intModuleID', DB_COLUMN_NUMERIC);			
		$this->addTableField('varComment');	
		$this->addTableField('varName');	
		$this->addTableField('isActive', DB_COLUMN_NUMERIC);
		$this->addTableField('varIsNew');
		$this->addTableField('varDate');
	}
	
}