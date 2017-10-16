<?php

Kernel::Import("system.db.abstracttable");

class ContactsContactTable extends AbstractTable {

	function ContactsContactTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_CONTACTS_CONTACT);
		$this->addTableField('intContactsContactID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intContactID', DB_COLUMN_NUMERIC);
		$this->addTableField('varText');
		$this->addTableField('varStaffType');
	}

}
