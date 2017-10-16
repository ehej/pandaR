<?php

Kernel::Import("system.db.abstracttable");

class ModulesPagesTable extends AbstractTable {

	function ModulesPagesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_MODULES_PAGES);
		
		$this->addTableField('intModulePageID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varPage');
		$this->addTableField('varTitle');
		$this->addTableField('varMetaTitle');
		$this->addTableField('varMetaDescription');
		$this->addTableField('varMetaKeywords');
		$this->addTableField('intContestID', DB_COLUMN_NUMERIC);
		$this->addTableField('varShowComments');
		$this->addTableField('onView');
	}
}