<?php

Kernel::Import("system.db.abstracttable");

class GeneralGalleryTable extends AbstractTable {

	function GeneralGalleryTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_GENERALGALLERY);
		
		$this->addTableField('intGeneralGalleryID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varName');
		$this->addTableField('varDescription');
		$this->addTableField('intOrder');
		$this->addTableField('varImage');
		$this->addTableField('varLink');
		$this->addTableField('intPublish');

	}

}