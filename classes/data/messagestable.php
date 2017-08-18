<?php
Kernel::Import("system.db.abstracttable");

class MessagesTable extends AbstractTable {

	function MessagesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_MESSAGES);
		
		$this->addTableField('intMessageID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varDate');
		$this->addTableField('varSubject');
		$this->addTableField('varMessage');	
		$this->addTableField('varFile1');
		$this->addTableField('varFile2');
		$this->addTableField('varFile3');
		$this->addTableField('varRealFile1Name');
		$this->addTableField('varRealFile2Name');
		$this->addTableField('varRealFile3Name');			
	}	
}