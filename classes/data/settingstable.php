<?php

Kernel::Import("system.db.abstracttable");

class SettingsTable extends AbstractTable {

	function SettingsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_SETTINGS);


		$this->addTableField('intSettingsID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intNewsAnnouncementCount');
		$this->addTableField('intNewsPageCount');
	}

}