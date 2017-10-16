<?php

Kernel::Import("system.db.abstracttable");

class PromoHotelDetailsTable extends AbstractTable {

	function PromoHotelDetailsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_PROMO_HOTEL_DETAILS);		
		$this->addTableField('intDetailsID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intHotelParent', DB_COLUMN_NUMERIC); 	
		$this->addTableField('varUsloviya'); 	
		$this->addTableField('varDateFrom'); 	
		$this->addTableField('varDateTo');
		$this->addTableField('varTextAdd');
	}

}
