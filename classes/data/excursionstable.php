<?php

Kernel::Import("system.db.abstracttable");

class ExcursionsTable extends AbstractTable {

	function ExcursionsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_EXCURSIONS);
		
		$this->addTableField('intExcursionID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varName');
		$this->addTableField('varMetaTitle');
		$this->addTableField('varMetaKeywords');
		$this->addTableField('varMetaDescription');
		$this->addTableField('varShowComments');
		$this->addTableField('isActive', DB_COLUMN_NUMERIC);
		$this->addTableField('varDescription');
	}
	
	public function getIDExc($val) {
		$SQL = sprintf('
			SELECT ex.intExcursionID 
			FROM %s as ex 
				LEFT JOIN %s AS rel on rel.intExcursionID = ex.intExcursionID and rel.varDestinationType = \'country\'
			WHERE  rel.intDestinationID = "'.$val.'"  
			ORDER BY ex.varName', $this->tableName, DB_TABLE_EXCURSIONS_RELATION);
		return $this->connection->ExecuteScalar($SQL, false);
	}
	
	function &getByCounry($data = null, $orders = null, $limitCount = null, $limitOffset = null) {
		$whereClause = "";
		if (!is_null($data)) {
			foreach ($this->columns as $column) {
				if (isset($data[$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= 'n.'.$column["name"] . "=" . AbstractTable::prepareColumnValue($column, $data[$column["name"]]);
				} elseif (!empty($data['LIKE'.$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= 'n.'.$column["name"] . " LIKE(" . AbstractTable::prepareColumnValue($column, '%'.$data['LIKE'.$column["name"]].'%') . ")";
				}
			}
		}
		if (isset($data['intCountryID']) && !empty($data['intCountryID'])) {
			if (!empty($whereClause)) $whereClause .= " AND ";
			$whereClause .= "relation.varDestinationType = 'country' AND relation.intDestinationID = ".$data['intCountryID'];
		}
		if (strlen($whereClause)) $whereClause = " WHERE " . $whereClause;
		$orderClause = "";
		if (is_array($orders)) {
			$keys = array_keys($orders);
			foreach ($keys as $key) {
				if (strlen($orderClause)) {
					$orderClause .= ", ";
				}
				$orderClause = $orderClause . 'n.'.$key . " ".$orders[$key];
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
		$SQL = sprintf("SELECT SQL_CALC_FOUND_ROWS n.*, relation.varDestinationType as varDestinationType, relation.intDestinationID as intDestinationID
						FROM %s as n
						LEFT JOIN %s as relation ON n.intExcursionID = relation.intExcursionID
						%s%s%s", $this->tableName, DB_TABLE_EXCURSIONS_RELATION, $whereClause, $orderClause, $limitClause);

		@$reader = &$this->connection->ExecuteReader($SQL);
		return $reader;
	}
	
}

class ExcursionsRelationTable extends AbstractTable {

	function ExcursionsRelationTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_EXCURSIONS_RELATION);
		
		$this->addTableField('intRelationID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intExcursionID', DB_COLUMN_NUMERIC);
		$this->addTableField('intDestinationID', DB_COLUMN_NUMERIC);
		$this->addTableField('varDestinationType');
	}
}
