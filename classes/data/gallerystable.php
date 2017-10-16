<?php

Kernel::Import("system.db.abstracttable");

class GallerysTable extends AbstractTable {

	function GallerysTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_GALLERYS);
		
		$this->addTableField('intGalleryID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varTitle');
		$this->addTableField('intPreviewWidth', DB_COLUMN_NUMERIC);
		$this->addTableField('intPreviewHeight', DB_COLUMN_NUMERIC);
		$this->addTableField('intCountImgInRow', DB_COLUMN_NUMERIC);
	}
	
	function getGalleriesForCurModule($gallIDs) {
		$SQL	=	sprintf("	SELECT *
								FROM %s 
								WHERE intGalleryID IN (".$gallIDs.");",	$this->tableName);

		return $this->connection->ExecuteScalar($SQL, false);
	}
	
}