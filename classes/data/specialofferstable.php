<?php

Kernel::Import("system.db.abstracttable");

class SpecialOffersTable extends AbstractTable {

	function SpecialOffersTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_SPECIAL_OFFERS);
		
		$this->addTableField('intSpecOffID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intSpecOffIDMT', DB_COLUMN_NUMERIC);
		$this->addTableField('varName');
		$this->addTableField('intCountryID', DB_COLUMN_NUMERIC);
		$this->addTableField('intRegionID', DB_COLUMN_NUMERIC);
		$this->addTableField('intDepadtureCityID', DB_COLUMN_NUMERIC);
		$this->addTableField('varDateCreated');
		$this->addTableField('varDateValid');
		$this->addTableField('varDateFrom');
		$this->addTableField('varDateTo');
		$this->addTableField('varDescription');
		$this->addTableField('varDuration');	
		$this->addTableField('intPromotionTypeID', DB_COLUMN_NUMERIC);
		$this->addTableField('isShow', DB_COLUMN_NUMERIC);
		$this->addTableField('varFile');
		$this->addTableField('varRealFileName');
		$this->addTableField('varFileXML');
		$this->addTableField('varRealFileXMLName');
		$this->addTableField('varInfo');
		$this->addTableField('varMinPrice');
		$this->addTableField('varLink');
		$this->addTableField('varInfoByLink');
	}

}