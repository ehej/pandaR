<?php

Kernel::Import("system.db.abstracttable");

class FormFieldsTable extends AbstractTable {

	function FormFieldsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_FORM_FIEDS);

		$this->addTableField('intFieldID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intFormID', DB_COLUMN_NUMERIC);
		$this->addTableField('intOrdering', DB_COLUMN_NUMERIC);
		$this->addTableField('varType');
		$this->addTableField('varName');
		$this->addTableField('varDescription');
		$this->addTableField('intImportant', DB_COLUMN_NUMERIC);
		$this->addTableField('varCheck');
		$this->addTableField('varErrorMessage');
		$this->addTableField('intMaxLenght', DB_COLUMN_NUMERIC);
		$this->addTableField('intSizeW', DB_COLUMN_NUMERIC);
		$this->addTableField('intSizeH', DB_COLUMN_NUMERIC);
		$this->addTableField('varDefaultValue');
		$this->addTableField('varValues');
		$this->addTableField('varAttribute');
		$this->addTableField('varTableSelect'); 	
	}
}