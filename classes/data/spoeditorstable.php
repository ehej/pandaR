<?php

Kernel::Import("system.db.abstracttable");

class SPOEditorsTable extends AbstractTable {

	function SPOEditorsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_SPO_EDITOR);
		
		$this->addTableField('intSPOEditorID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varName');	
		$this->addTableField('varDepartureDate');		
		$this->addTableField('varValidUntilDate');
		$this->addTableField('intHideAfterTheExpiration', DB_COLUMN_NUMERIC);
		$this->addTableField('isShow', DB_COLUMN_NUMERIC);
		$this->addTableField('isAuthorized', DB_COLUMN_NUMERIC);
		$this->addTableField('varPrice');
		$this->addTableField('varLabel');
		$this->addTableField('varImage');
		$this->addTableField('varLink');
		$this->addTableField('varRealImageName');
		$this->addTableField('varColorBG');
		$this->addTableField('varColorRO');
	}
}