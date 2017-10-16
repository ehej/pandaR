<?php

Kernel::Import("system.db.abstracttable");

class ContestsTable extends AbstractTable {

	function ContestsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_CONTESTS);
		
		$this->addTableField('intContestID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varTitle');
		$this->addTableField('intCountQuestionsInPage', DB_COLUMN_NUMERIC);
	}
	
}