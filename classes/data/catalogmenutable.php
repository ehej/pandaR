<?php

Kernel::Import("system.db.abstracttable");

class CatalogMenuTable extends AbstractTable {

	function CatalogMenuTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_CATALOG_MENU);
		
		$this->addTableField('intMenuID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intMenuParentID', DB_COLUMN_NUMERIC);
		$this->addTableField('varTitle');
		$this->addTableField('varColor');
		$this->addTableField('varUrl');
		$this->addTableField('intParentID', DB_COLUMN_NUMERIC);
		$this->addTableField('varParentType');
		$this->addTableField('intCountryID', DB_COLUMN_NUMERIC);
		$this->addTableField('intSortOrder', DB_COLUMN_NUMERIC);
		$this->addTableField('varModule');
		$this->addTableField('varIdentifier');
		$this->addTableField('isCharter', DB_COLUMN_NUMERIC);
		$this->addTableField('addToSO', DB_COLUMN_NUMERIC);
		$this->addTableField('isVisible', DB_COLUMN_NUMERIC);
		$this->addTableField('isAllwaysOpen', DB_COLUMN_NUMERIC);
	}
}
