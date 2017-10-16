<?php

Kernel::Import("system.db.abstracttable");

class BannersMainTable extends AbstractTable {

	function BannersMainTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_BANNERS_MAIN);
		
		$this->addTableField('intBannerZoneID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varName');
		$this->addTableField('varBanner1Name');
		$this->addTableField('varBanner1RealName');
		$this->addTableField('varLink1');
		$this->addTableField('varBanner2Name');
		$this->addTableField('varBanner2RealName');
		$this->addTableField('varLink2');
		$this->addTableField('varBanner3Name');
		$this->addTableField('varBanner3RealName');
		$this->addTableField('varLink3');
		$this->addTableField('varBanner4Name');
		$this->addTableField('varBanner4RealName');
		$this->addTableField('varLink4');
		$this->addTableField('varBanner5Name');
		$this->addTableField('varBanner5RealName');
		$this->addTableField('varLink5');
		$this->addTableField('varBanner6Name');
		$this->addTableField('varBanner6RealName');
		$this->addTableField('varLink6');
		$this->addTableField('varBanner7Name');
		$this->addTableField('varBanner7RealName');
		$this->addTableField('varLink7');
		$this->addTableField('varBanner8Name');
		$this->addTableField('varBanner8RealName');
		$this->addTableField('varLink8');
		$this->addTableField('isDefault', DB_COLUMN_NUMERIC);
		$this->addTableField('isShowSection_1', DB_COLUMN_NUMERIC);
		$this->addTableField('isShowSection_2', DB_COLUMN_NUMERIC);
		$this->addTableField('intWidth1', DB_COLUMN_NUMERIC);
		$this->addTableField('intHeight1', DB_COLUMN_NUMERIC);
		$this->addTableField('intWidth2', DB_COLUMN_NUMERIC);
		$this->addTableField('intHeight2', DB_COLUMN_NUMERIC);
		$this->addTableField('intWidth3', DB_COLUMN_NUMERIC);
		$this->addTableField('intHeight3', DB_COLUMN_NUMERIC);
		$this->addTableField('intWidth4', DB_COLUMN_NUMERIC);
		$this->addTableField('intHeight4', DB_COLUMN_NUMERIC);
		$this->addTableField('intWidth5', DB_COLUMN_NUMERIC);
		$this->addTableField('intHeight5', DB_COLUMN_NUMERIC);
		$this->addTableField('intWidth6', DB_COLUMN_NUMERIC);
		$this->addTableField('intHeight6', DB_COLUMN_NUMERIC);
		$this->addTableField('intWidth7', DB_COLUMN_NUMERIC);
		$this->addTableField('intHeight7', DB_COLUMN_NUMERIC);
		$this->addTableField('intWidth8', DB_COLUMN_NUMERIC);
		$this->addTableField('intHeight8', DB_COLUMN_NUMERIC);
		
	}
	
}