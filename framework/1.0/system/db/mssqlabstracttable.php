<?php
Kernel::Import("system.db.abstracttable");

define("DB_COLUMN_NUMERIC", 1);
define("DB_COLUMN_STRING", 2);

class MSSQlAbstractTable extends AbstractTable {
	
	function MSSQlAbstractTable(&$connection, $tableName) {
		$this->connection = &$connection;
		$this->tableName = $tableName;
	}
	
	function getInsertId() {
		return mssql_insert_id();
	}
	
	function mssql_insert_id() {
		$id = false;
		$res = mssql_query('SELECT @@identity AS id');
		if ($row = mssql_fetch_row($res)) {
			$id = trim($row[0]);
		}
		mssql_free_result($res);
		return $id;
	}

	function SqlString($string) {
		return "'".addslashes((string) $string)."'";
	}
	
	function &GetReader($data = null, $orders = null, $limitCount = null, $limitOffset = null) {
		$whereClause = "";
		if (!is_null($data)) {
			foreach ($this->columns as $column) {
				
				if (isset($data[$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= $column["name"] . "=" . AbstractTable::prepareColumnValue($column, $data[$column["name"]]);
				}
				if (!empty($data['LIKE'.$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= $column["name"] . " LIKE(" . AbstractTable::prepareColumnValue($column, '%'.$data['LIKE'.$column["name"]].'%') . ")";
				}
				if (!empty($data['FROM'.$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= $column["name"] . " >= " . AbstractTable::prepareColumnValue($column, $data['FROM'.$column["name"]]);
				}
				if (!empty($data['TO'.$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= $column["name"] . " <= " . AbstractTable::prepareColumnValue($column, $data['TO'.$column["name"]]);
				}
				if (!empty($data['IN'.$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= $column["name"] . " IN (" . $data['IN'.$column["name"]].") ";
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
				$orderClause = $orderClause . $key . " ".$orders[$key];
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
		$SQL = sprintf("SELECT * FROM %s%s%s%s", $this->tableName, $whereClause, $orderClause, $limitClause);
		@$reader = &$this->connection->ExecuteReader($SQL);
		return $reader;
	}

}
