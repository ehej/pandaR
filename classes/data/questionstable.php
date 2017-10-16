<?php

Kernel::Import("system.db.abstracttable");

class QuestionsTable extends AbstractTable {

	function QuestionsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_QUESTIONS);
		
		$this->addTableField('intQuestionID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intContestID', DB_COLUMN_NUMERIC);
		$this->addTableField('varQuestionText');
	}

}
