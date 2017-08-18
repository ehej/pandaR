<?php

Kernel::Import("system.db.abstracttable");

class ImagesTable extends AbstractTable {

	function ImagesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_IMAGES);
		
		$this->addTableField('intImageID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intGalleryID', DB_COLUMN_NUMERIC);
		$this->addTableField('varFileName');
		$this->addTableField('varRealFileName');
		$this->addTableField('intOrder', DB_COLUMN_NUMERIC);
		$this->addTableField('varTitle');
	}
	
	function getMaxOrder($intGalleryID) {
		$SQL = "SELECT MAX(intOrder) AS maxOrder FROM ".$this->tableName." WHERE intImageID=".$intGalleryID;
		$res = $this->connection->ExecuteScalar($SQL);
		return intval($res['maxOrder']+1);
	}
	
	function getImagesForCurModule($gallIDs, $file = '') {
		if($file == 'hotel'){
			$limit = ' LIMIT 5 ';
		}else{
			$limit = '';
		}
		
		$SQL	=	sprintf("	SELECT *
								FROM %s 
								WHERE intGalleryID IN (".$gallIDs.") ORDER BY intOrder %s;",	$this->tableName, $limit);

		return $this->connection->ExecuteScalar($SQL, false);
	}
	
}