<?php

Kernel::Import("system.db.abstracttable");

class AbstractHistoryTable extends AbstractTable {
	/**
	 * @var MySQLConnection
	 */
	var $connection;
	var $columns = array();
	var $tableName = '';

	function AbstractHistoryTable(&$connection, $tableName) {
		parent::AbstractTable($connection, $tableName);
	}

	function OnBeforeGet(&$data) {
		if (!isset($data['showDeleted']) && !isset($data['isDeleted'])) $data['isDeleted'] = 0;
	}

	function OnAfterGet(&$data, &$result) {
	}

	function Get($data, $orders = null) {
		$result = array();
		$keyColumn = $this->getKeyColumn();
		if (is_array($keyColumn)) {
			$this->OnBeforeGet($data);
			$whereClause = " WHERE ";
			$whereClause .= $keyColumn["name"] . "=" . AbstractTable::prepareColumnValue($keyColumn, $data[$keyColumn["name"]]);
			$orderClause = '';
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
			$SQL = sprintf("SELECT * FROM %s %s %s LIMIT 0, 1", $this->tableName, $whereClause, $orderClause);
			$result = $this->connection->ExecuteScalar($SQL);
			$this->OnAfterGet($data, $result);
		}
		return $result;
	}

	function GetByFields($data = null, $orders = null, $limited = true) {
		$result = array();
		$whereClause = "";
		$orderClause = "";
		$this->OnBeforeGet($data);
		foreach ($this->columns as $column) {
			if (isset($data[$column["name"]])) {
				if (strlen($whereClause)) $whereClause .= " AND ";
				$whereClause .= $column["name"] . "=" . AbstractTable::prepareColumnValue($column, $data[$column["name"]]);
			}
		}
		if (strlen($whereClause)) $whereClause = " WHERE " . $whereClause;
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
		$SQL = sprintf("SELECT * FROM %s %s %s", $this->tableName, $whereClause, $orderClause);
		$result = $this->connection->ExecuteScalar($SQL, $limited);
		$this->OnAfterGet($data, $result);
		return $result;
	}

	function GetList($data = null, $orders = null, $decorator = null, $readerMethod = null, $counterMethod = null, $withPager = false, $page = 1, $itemsPerPage = 10) {
		if (is_null($counterMethod)) $counterMethod = "GetCount";
		if (is_null($readerMethod)) $readerMethod = "GetReader";
		$this->OnBeforeGet($data);
		if (!$withPager) {
			$reader = $this->$readerMethod($data, $orders);
			$return =  $this->buildList($reader, $decorator);
			$this->OnAfterGet($data, $return);
			return $return;
		}
		if ($page < 1 ) $page = 1;
		$return = $this->buildList($this->$readerMethod($data, $orders, $itemsPerPage, $itemsPerPage * ($page - 1)), $decorator);
		// With pager section
		$itemsCount = $this->$counterMethod($data);
		$pageCount = (int) (($itemsCount - 1) / $itemsPerPage) + 1;
		if ($page < 1 || $page > $pageCount) $page = 1;

		if ($pageCount > 1) {
			$return['pager'] = $this->buildPager($page, $itemsCount, $itemsPerPage);
		}
		if( is_null($return) ) {
			$return = array();
		}
		$this->OnAfterGet($data, $return);		
		return $return;
	}
	
// Delete with history
	function DeleteByFields(&$data) {
		if (count($data)) {
			$this->OnBeforeDelete($data);
			if (isset($data['adminID'])) {
				$adminID = $data['adminID'];
				unset($data['adminID']);
			}
			$SQL = "isDeleted=1, intChangedBy=".$adminID;
			$whereClause = "";
			while (list($_key, $_value) = each($data)) {
				if (strlen($whereClause)) $whereClause .= " AND ";
				$whereClause .= $_key . "='" . $_value ."'";
			}
			$SQL = sprintf("UPDATE %s SET %s WHERE %s", $this->tableName, $SQL, $whereClause);
			$this->connection->ExecuteNonQuery($SQL);
			$this->OnAfterDelete($data);
			$data = array();
		}
	}

	function Delete(&$data) {
		$keyColumn = $this->getKeyColumn();
		if (is_array($keyColumn)) {
			$this->OnBeforeDelete($data);
			if (isset($data['adminID'])) {
				$adminID = $data['adminID'];
				unset($data['adminID']);
			}
			$SQL = "isDeleted=1, intChangedBy=".$adminID;
			$whereClause = "";
			$whereClause .= $keyColumn["name"] . "=" . AbstractTable::prepareColumnValue($keyColumn, $data[$keyColumn["name"]]);
			$SQL = sprintf("UPDATE %s SET %s WHERE %s", $this->tableName, $SQL, $whereClause);
			$this->connection->ExecuteNonQuery($SQL);
			$this->OnAfterDelete($data);
			$data = array();
		}
	}
}
