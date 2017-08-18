<?php

Kernel::Import("system.db.abstracttable");

class OrdersTable extends AbstractTable {

	function OrdersTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_ORDERS);

		$this->addTableField('intOrderID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intTourID', DB_COLUMN_NUMERIC);
		$this->addTableField('varTourName');
		$this->addTableField('varFIO');
		$this->addTableField('varComments');
		$this->addTableField('varDateFrom');
		$this->addTableField('varDateTo');
		$this->addTableField('varMail');
		$this->addTableField('varTel');
		$this->addTableField('intDays', DB_COLUMN_NUMERIC);

	}

}
