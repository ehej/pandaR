<?php

Kernel::Import("system.db.abstracttable");

class PromoHotelsTable extends AbstractTable {

	function PromoHotelsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_PROMO_HOTEL);
		$this->addTableField('intHotelPromoID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intParentPromo', DB_COLUMN_NUMERIC);
		$this->addTableField('varNameHotel');
		$this->addTableField('intAkcent', DB_COLUMN_NUMERIC);
		$this->addTableField('varLink');
	}

}
