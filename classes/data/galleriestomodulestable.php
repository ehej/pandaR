<?php

Kernel::Import("system.db.abstracttable");

class GalleriesToModulesTable extends AbstractTable {

	function GalleriesToModulesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_GALLERIES_TO_MODULES);
		
		$this->addTableField('intGallToModID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varModuleName');
		$this->addTableField('intModuleID', DB_COLUMN_NUMERIC);
		$this->addTableField('intGalleryID', DB_COLUMN_NUMERIC);
	}

}
