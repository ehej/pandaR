<?php

Kernel::Import("system.db.abstracttable");

class BannersToModulesTable extends AbstractTable {

	function BannersToModulesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_BANNERS_TO_MODULES);
		
		$this->addTableField('intBannToModID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varModuleName');
		$this->addTableField('intModuleID', DB_COLUMN_NUMERIC);
		$this->addTableField('intBannerZoneID', DB_COLUMN_NUMERIC);
	}

}
