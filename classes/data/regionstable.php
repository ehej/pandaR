<?php

Kernel::Import("system.db.abstracttable");

class RegionsTable extends AbstractTable {

	function RegionsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_REGIONS);
		
		$this->addTableField('intRegionID', DB_COLUMN_NUMERIC, true);		
		$this->addTableField('intResortID', DB_COLUMN_NUMERIC);
		$this->addTableField('varName');
		$this->addTableField('varUrlAlias');
		$this->addTableField('varMetaKeywords');
		$this->addTableField('varMetaDescription');
		$this->addTableField('varDescription');
		$this->addTableField('varShowComments');
		$this->addTableField('intMTCityID', DB_COLUMN_NUMERIC);
		$this->addTableField('isActive', DB_COLUMN_NUMERIC);
		$this->addTableField('isViewInMenu', DB_COLUMN_NUMERIC);
	}
	
	public function getListIDsNames() {
		$SQL = sprintf('SELECT intRegionID, intCountryID, varName, intMTCityID
						FROM %s ORDER BY varName;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
	
	public function getListIDsNamesByCountryID($intCountryID) {
		$SQL = sprintf('SELECT intRegionID, intCountryID, varName, intMTCityID
						FROM %s 
						WHERE intCountryID = '.$intCountryID.';', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
	public function getListIDsUrl() {
		$SQL = sprintf('SELECT intRegionID as identificator, varUrlAlias
						FROM %s;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
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
	    $SQL = sprintf("SELECT SQL_CALC_FOUND_ROWS r.*, rr.varName as varResortName, c.varName AS varCountryName FROM %s AS r
		LEFT JOIN %s AS rr ON rr.intResortID = r.intResortID
		LEFT JOIN %s AS c ON rr.intCountryID = c.intCountryID %s %s %s", $this->tableName, DB_TABLE_RESORTS, DB_TABLE_COUNTRIES, $whereClause, $orderClause, $limitClause);
		@$reader = &$this->connection->ExecuteReader($SQL);
		return $reader;
	}
	
}