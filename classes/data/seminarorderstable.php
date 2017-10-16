
<?php

Kernel::Import("system.db.abstracttable");

class SeminarOrdersTable extends AbstractTable {

	function SeminarOrdersTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_SEMINARS);

		$this->addTableField('intSeminarOrderID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varCityName');
		$this->addTableField('varCompanyName');		
		$this->addTableField('varFIO');
		$this->addTableField('varComments');
		$this->addTableField('varMail');
		$this->addTableField('varTel');
		$this->addTableField('intCountPeople', DB_COLUMN_NUMERIC);

	}

}