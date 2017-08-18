<?php

Kernel::Import("system.db.abstracttable");

class ApplicationsTable extends AbstractTable {

	function ApplicationsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_APPLICATIONS);

		$this->addTableField('intApplicationID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intCountryID', DB_COLUMN_NUMERIC);
		$this->addTableField('intRegionID', DB_COLUMN_NUMERIC);
		$this->addTableField('varTourName');
		$this->addTableField('varHotelName');
		$this->addTableField('varDateFrom');
		$this->addTableField('varDateTo');
		$this->addTableField('varCountPersons');
		$this->addTableField('varRoomType');
		$this->addTableField('varCountRooms');
		$this->addTableField('varPayType');
		$this->addTableField('varAppComments');
		$this->addTableField('varPrice');
		$this->addTableField('varStatus');
		$this->addTableField('varPersonFirstName');
		$this->addTableField('varPersonLastName');
		$this->addTableField('varPersonEmail');
		$this->addTableField('varPersonAddress');
		$this->addTableField('varPersonPhoneFax');
		$this->addTableField('varPersonComments');
		$this->addTableField('varIsNew');
	}

}
