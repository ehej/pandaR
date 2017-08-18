<?php

Kernel::Import("system.db.abstracttable");

class PlaceTypesTable extends AbstractTable {

	function PlaceTypesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_PLACETYPES);
		
		$this->addTableField('intPlaceTypeID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varName');

	}
	
	function getByTour($ID = null){
		if(!$ID) return;
		$SQL = sprintf('SELECT varName FROM %s p JOIN %s a USING(intPlaceTypeID) WHERE a.intTourID=%d GROUP BY p.intPlaceTypeID ORDER BY varName',$this->tableName, DB_TABLE_TOURS_PLACEMENT, $ID);
		$res = $this->connection->ExecuteScalar($SQL,false);
		$result = array();
		foreach($res as $row) {
			$result[] = $row['varName'];
		}
		return $result;
	}
}