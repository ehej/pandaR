<?php

Kernel::Import("system.db.abstracttable");

class ResortsTable extends AbstractTable {

	function ResortsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_RESORTS);
		$this->addTableField('intResortID', DB_COLUMN_NUMERIC, true);		
		$this->addTableField('intCountryID', DB_COLUMN_NUMERIC);
		$this->addTableField('varName');
		$this->addTableField('varUrlAlias');
		$this->addTableField('varMetaTitle');
		$this->addTableField('varMetaKeywords');
		$this->addTableField('varMetaDescription');
		$this->addTableField('varShortDescription');
		$this->addTableField('varDescription');
		$this->addTableField('varShowComments');
		$this->addTableField('isActive', DB_COLUMN_NUMERIC);
		$this->addTableField('isViewInMenu', DB_COLUMN_NUMERIC);
		$this->addTableField('isAllwaysOpen', DB_COLUMN_NUMERIC);
		
	}
	
	public function getListIDsNames() {
		$SQL = sprintf('SELECT intResortID, intCountryID, varName
						FROM %s;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
	
	public function getListIDsNamesByCountryID($intCountryID) {
		$SQL = sprintf('SELECT intResortID, intCountryID, varName
						FROM %s 
						WHERE intCountryID = '.$intCountryID.';', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
	
	public function getListIDsUrl() {
		$SQL = sprintf('SELECT intResortID as identificator, varUrlAlias
						FROM %s;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
	
	function getByTour($ID = null){
		if(!$ID) return;
		$SQL = sprintf('SELECT varName FROM %s p JOIN %s a USING(intResortID) WHERE a.intTourID=%d GROUP BY p.intResortID ORDER BY varName LIMIT 5',$this->tableName, DB_TABLE_TOURS_RESORTS, $ID);
		$res = $this->connection->ExecuteScalar($SQL,false);
		$result = array();
		foreach($res as $row) {
			$result[] = $row['varName'];
		}
		return $result;
	}
	
	function &GetListWithCountryName($data = null, $orders = null, $limitCount = null, $limitOffset = null) {
		$whereClause = "";
		if (!is_null($data)) {
			foreach ($this->columns as $column) {
				if (isset($data[$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= "r.".$column["name"] . "=" . AbstractTable::prepareColumnValue($column, $data[$column["name"]]);
				} elseif (!empty($data['LIKE'.$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= "r.".$column["name"] . " LIKE(" . AbstractTable::prepareColumnValue($column, '%'.$data['LIKE'.$column["name"]].'%') . ")";
				}
			}
		}
		if (strlen($whereClause)) $whereClause = " WHERE " . $whereClause;
		$orderClause = "";
		if (is_array($orders)) {
			$keys = array_keys($orders);
			foreach ($keys as $key) {
				if (strlen($orderClause)) {
					$orderClause .= ", ";
				}
				$orderClause = $orderClause . "".$key . " ".$orders[$key];
			}
		}
		if (strlen($orderClause)) {
			$orderClause = " ORDER BY " . $orderClause;
		}
		$limitClause = "";
		if (!is_null($limitCount)) {
			if (!is_null($limitOffset)) $limitClause = $limitOffset . ", ";
			$limitClause = " LIMIT " . $limitClause . $limitCount;
		}
	    $SQL = sprintf("SELECT SQL_CALC_FOUND_ROWS r.intResortID, r.intCountryID, r.varName, c.varName AS varCountryName, r.isActive FROM %s AS r 
		LEFT JOIN %s AS c ON r.intCountryID = c.intCountryID %s %s %s", $this->tableName, DB_TABLE_COUNTRIES, $whereClause, $orderClause, $limitClause);
		@$reader = &$this->connection->ExecuteReader($SQL);
		return $reader;
	}
	
}
