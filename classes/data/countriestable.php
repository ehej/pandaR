<?php

Kernel::Import("system.db.abstracttable");

class CountriesTable extends AbstractTable {

	function CountriesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_COUNTRIES);
		
		$this->addTableField('intCountryID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varName');
		$this->addTableField('varUrlAlias');
		$this->addTableField('varMetaTitle');
		$this->addTableField('varMetaKeywords');
		$this->addTableField('varMetaDescription');
		$this->addTableField('varDescription');
		$this->addTableField('varDescriptionCountry');
		$this->addTableField('varFlag');
		$this->addTableField('varRealFlagName');
		$this->addTableField('intMTCountryID', DB_COLUMN_NUMERIC);
		$this->addTableField('intMenuID', DB_COLUMN_NUMERIC);
		$this->addTableField('varShowComments');
		$this->addTableField('isActive', DB_COLUMN_NUMERIC);
		$this->addTableField('isShowSPO', DB_COLUMN_NUMERIC);
		$this->addTableField('intOrder', DB_COLUMN_NUMERIC);
	}

	public function getListIDsNames() {
		$SQL = sprintf('SELECT intCountryID, varName, intMTCountryID
						FROM %s ORDER BY varName;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
	public function getListIDsUrl() {
		$SQL = sprintf('SELECT intCountryID as identificator, varUrlAlias
						FROM %s;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
	
	function &getWithData($data = null, $orders = null, $limitCount = null, $limitOffset = null){
		
		$whereClause = '';
		if (!is_null($data)) {
			if (!empty($data['intTypeID'])) {
				if (strlen($whereClause)) $whereClause .= " AND ";
				$whereClause .= "c.intTypeID=".$data["intTypeID"];
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
				$orderClause = $orderClause . "t.".$key . " ".$orders[$key];
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
		$SQL = sprintf("SELECT SQL_CALC_FOUND_ROWS t.* 
			FROM %s AS t
			LEFT JOIN %s AS c ON c.intCountryID = t.intCountryID
			%s %s %s", 
			$this->tableName, DB_TABLE_TOURS, $whereClause, $orderClause, $limitClause);
		
		@$reader = &$this->connection->ExecuteReader($SQL);
		return $reader;
	}
}