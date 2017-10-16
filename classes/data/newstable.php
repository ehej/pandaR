<?php

Kernel::Import("system.db.abstracttable");

class NewsTable extends AbstractTable {

	function NewsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_NEWS);
		
		$this->addTableField('intNewsID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intNewsTypeID', DB_COLUMN_NUMERIC);
		$this->addTableField('varTitle');
		$this->addTableField('varAnnotation');
		$this->addTableField('varDescription');
		$this->addTableField('varMetaTitle');
		$this->addTableField('varMetaKeywords');
		$this->addTableField('varMetaDescription');
		$this->addTableField('intContestID', DB_COLUMN_NUMERIC);
		$this->addTableField('intActive', DB_COLUMN_NUMERIC);
		$this->addTableField('intOnlyAuthorized', DB_COLUMN_NUMERIC);
		$this->addTableField('varDate');
		$this->addTableField('varShowComments');
		$this->addTableField('intShowHome');
	}

	function &GetWithCurDate($data = null, $orders = null, $limitCount = null, $limitOffset = null) {
		$whereClause = "";
		if (!is_null($data)) {
			foreach ($this->columns as $column) {
				if (isset($data[$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= $column["name"] . "=" . AbstractTable::prepareColumnValue($column, $data[$column["name"]]);
				} elseif (!empty($data['LIKE'.$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= $column["name"] . " LIKE(" . AbstractTable::prepareColumnValue($column, '%'.$data['LIKE'.$column["name"]].'%') . ")";
				}
			}
		}

		if (isset($data['varDateFrom'])) {
			if (strlen($whereClause)) $whereClause .= " AND ";
			$whereClause .= 'n.varDate > '.AbstractTable::prepareColumnValue('varDateFrom', $data['varDateFrom']);
		}
		if (isset($data['varDateTo'])) {
			if (strlen($whereClause)) $whereClause .= " AND ";
			$whereClause .= 'n.varDate < '.AbstractTable::prepareColumnValue('varDateTo', $data['varDateTo']);
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
		$SQL = sprintf("SELECT SQL_CALC_FOUND_ROWS n.* 
						FROM %s as n
						%s%s%s", $this->tableName, $whereClause, $orderClause, $limitClause);

		@$reader = &$this->connection->ExecuteReader($SQL);
		return $reader;
	}
}