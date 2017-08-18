<?php

Kernel::Import("system.db.abstracttable");

class BannersRightTable extends AbstractTable {

	function BannersRightTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_BANNERS_RIGHT);
		
		$this->addTableField('intBannerRightID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varBannerName');
		$this->addTableField('varBannerRealName');
		$this->addTableField('isShowBanner', DB_COLUMN_NUMERIC);
		$this->addTableField('intSortOrder', DB_COLUMN_NUMERIC);
		$this->addTableField('varLink');
		$this->addTableField('w', DB_COLUMN_NUMERIC);
		$this->addTableField('h', DB_COLUMN_NUMERIC);
	}
	
}