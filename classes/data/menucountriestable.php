<?php

Kernel::Import("system.db.abstracttable");

class MenuCountriesTable extends AbstractTable {

	function MenuCountriesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_MENU_COUNTRIES);
		
		$this->addTableField('intMenuID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varTitle');
		$this->addTableField('varColor');
		$this->addTableField('varUrl');
		$this->addTableField('intParentID', DB_COLUMN_NUMERIC);
		$this->addTableField('intCountryID', DB_COLUMN_NUMERIC);
		$this->addTableField('intSortOrder', DB_COLUMN_NUMERIC);
		$this->addTableField('varModule');
		$this->addTableField('varIdentifier');
		$this->addTableField('isCharter', DB_COLUMN_NUMERIC);
		$this->addTableField('addToSO', DB_COLUMN_NUMERIC);
		$this->addTableField('intPlusSeparator', DB_COLUMN_NUMERIC);
		$this->addTableField('isVisible', DB_COLUMN_NUMERIC);
		$this->addTableField('isAuthorized', DB_COLUMN_NUMERIC);
	}
}