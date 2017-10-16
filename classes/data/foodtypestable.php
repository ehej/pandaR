<?php

Kernel::Import("system.db.abstracttable");

class FoodTypesTable extends AbstractTable {

	function FoodTypesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_FOODTYPES);
		
		$this->addTableField('intFoodTypeID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varName');

	}
	
	function getByTour($ID = null){
		if(!$ID) return;
		$SQL = sprintf('SELECT varName FROM %s p JOIN %s a USING(intFoodTypeID) WHERE a.intTourID=%d GROUP BY p.intFoodTypeID ORDER BY varName',$this->tableName, DB_TABLE_TOURS_FOODTYPES, $ID);
		$res = $this->connection->ExecuteScalar($SQL,false);
		$result = array();
		foreach($res as $row) {
			$result[] = $row['varName'];
		}
		return $result;
	}
}