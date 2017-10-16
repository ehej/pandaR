<?php

Kernel::Import("system.db.abstracttable");

class HotelsOptionTable extends AbstractTable {
	function HotelsOptionTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_HOTEL_OPTIONS);
		$this->addTableField('intOptionID', DB_COLUMN_NUMERIC, true);	
		$this->addTableField('intOrdering', DB_COLUMN_NUMERIC);	
		$this->addTableField('varName');	
	}
	
	public function getOptionRelation($hotel_id = false) {
		if($hotel_id){
			if(is_array($hotel_id)){
				$hotel_id[] = -1;
				$where = ' WHERE intHotelID in ('.implode(',',$hotel_id).')';
			}else{
				$where = ' WHERE intHotelID = '.$hotel_id;
			}
		}else{
			return array();
		}
		$SQL = sprintf('SELECT * FROM %s %s;', DB_TABLE_HOTEL_OPTIONS_RELATION, $where);
		return $this->connection->ExecuteScalar($SQL, false);
	}
	
	public function getHotelRelation($option_id = false) {
		if($option_id){
			if(is_array($option_id)){
				$option_id[] = -1;
				$where = ' WHERE intOptionID in ('.implode(',',$option_id).')';
			}else{
				$where = ' WHERE intOptionID = '.$option_id;
			}
		}else{
			$where = '';
		}
		$SQL = sprintf('SELECT * FROM %s %s;', DB_TABLE_HOTEL_OPTIONS_RELATION, $where);
		return $this->connection->ExecuteScalar($SQL, false);
	}
	public function insertOptionRelation($hotel_id , $resortID, $option) {
		$SQL = sprintf('INSERT INTO %s SET intHotelID = "%s", intResortID = "%s" , intOptionID = "%s" ;', DB_TABLE_HOTEL_OPTIONS_RELATION, $hotel_id , $resortID, $option);
		return $this->connection->ExecuteNonQuery($SQL);
	}
	public function deleteOptionRelation($hotel_id) {
		$SQL = sprintf('DELETE FROM %s WHERE intHotelID = "%s" ;', DB_TABLE_HOTEL_OPTIONS_RELATION, $hotel_id);
		return $this->connection->ExecuteNonQuery($SQL);
	}
	public function deleteOptionRelationOPID($option_id) {
		$SQL = sprintf('DELETE FROM %s WHERE intOptionID = "%s" ;', DB_TABLE_HOTEL_OPTIONS_RELATION, $option_id);
		return $this->connection->ExecuteNonQuery($SQL);
	}
}