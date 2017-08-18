<?php

Kernel::Import("system.db.abstracttable");

class AnswersTable extends AbstractTable {

	function AnswersTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_ANSWERS);
		
		$this->addTableField('intAnswerID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intQuestionID', DB_COLUMN_NUMERIC);
		$this->addTableField('varAnswerText');
		$this->addTableField('isRight', DB_COLUMN_NUMERIC);
	}

}
