<?php

Kernel::Import("system.db.abstracttable");

class ContactsTable extends AbstractTable {

	function ContactsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_CONTACTS);
		$this->addTableField('intContactID', DB_COLUMN_NUMERIC, true); 
		$this->addTableField('varName'); 	
		$this->addTableField('varView');
		$this->addTableField('varFoto');
		$this->addTableField('varMain');
		$this->addTableField('varInfo');
		$this->addTableField('varTransport');
	}
}
