<?php

Kernel::Import("system.db.abstracttable");

class FormsTable extends AbstractTable {

	function FormsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_FORMS);

		$this->addTableField('intFormID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varName');
		$this->addTableField('varEmailTO');
		$this->addTableField('varEmailFrom');
		$this->addTableField('varFromName');
		$this->addTableField('varSubject');
		$this->addTableField('varTemplate');
		$this->addTableField('varTemplateForm');
		$this->addTableField('varIdentificator');
		$this->addTableField('varDescription');
		$this->addTableField('isActive', DB_COLUMN_NUMERIC);
	}
}