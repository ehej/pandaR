<?php

Kernel::Import("system.db.abstracttable");

class PromoTable extends AbstractTable {

	function PromoTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_PROMO);
		$this->addTableField('intPromoID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varName'); 	
		$this->addTableField('varHead'); 	
		$this->addTableField('varFoot'); 
		$this->addTableField('isActive'); 	
		$this->addTableField('intCountryID', DB_COLUMN_NUMERIC);
	}
}
