<?php

Kernel::Import("system.db.abstracttable");

class StaffsContactTable extends AbstractTable {

	function StaffsContactTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_STAFFS_CONTACT);
		$this->addTableField('intContactID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intStaffID', DB_COLUMN_NUMERIC);
		$this->addTableField('varText');
		$this->addTableField('varStaffType');
	}

}
