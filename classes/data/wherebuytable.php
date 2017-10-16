<?php

Kernel::Import("system.db.abstracttable");

class WhereBuyTable extends AbstractTable {

	function WhereBuyTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_WHERE_BUY);
		
		$this->addTableField('intWhereBuyID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intAreaID', DB_COLUMN_NUMERIC);
		$this->addTableField('intCityID', DB_COLUMN_NUMERIC);
		$this->addTableField('varName');
		$this->addTableField('varPhone');
		$this->addTableField('varDetail');
		$this->addTableField('varActivelyTo');
		$this->addTableField('varMIBSAgency');
	}
}