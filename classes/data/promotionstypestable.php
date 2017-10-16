<?php

Kernel::Import("system.db.abstracttable");

class PromotionsTypesTable extends AbstractTable {

	function PromotionsTypesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_PROMOTIONS_TYPES);
		
		$this->addTableField('intPromotionTypeID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varName');
		$this->addTableField('varColapse');
	}
	
}