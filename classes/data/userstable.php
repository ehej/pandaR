<?php

Kernel::Import("system.db.abstracttable");

class UsersTable extends AbstractTable {

	function UsersTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_USERS);

		$this->addTableField('intUserID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varLogin');
		$this->addTableField('varPassword');
		$this->addTableField('varEmail');
		$this->addTableField('varFIO');
		$this->addTableField('varPhone');
		$this->addTableField('varName');
		$this->addTableField('varOwnership');
		$this->addTableField('varEGRPO');
		$this->addTableField('varUrName');
		$this->addTableField('varBankGuarantee');
		$this->addTableField('varTels');
		$this->addTableField('varFax');
		$this->addTableField('varUrIndex');
		$this->addTableField('varUrCity');
		$this->addTableField('varUrAddress');
		$this->addTableField('varFizIndex');
		$this->addTableField('varFizCity');
		$this->addTableField('varFizAddress');
		$this->addTableField('varCreatedTime');
		$this->addTableField('isActive', DB_COLUMN_NUMERIC);
		$this->addTableField('intValid', DB_COLUMN_NUMERIC);
	}



	function &GetUsersList($data = null, $orders = null, $limitCount = null, $limitOffset = null) {
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
		$SQL = sprintf("SELECT SQL_CALC_FOUND_ROWS * FROM %s%s%s%s", $this->tableName, $whereClause, $orderClause, $limitClause);
		@$reader = &$this->connection->ExecuteReader($SQL);
		return $reader;
	}

}