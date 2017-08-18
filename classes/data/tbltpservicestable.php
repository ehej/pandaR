<?php

Kernel::Import("system.db.mssqlabstracttable");

class TblTpServicesTable extends MSSQlAbstractTable {

	function TblTpServicesTable(&$connection) {
		parent::MSSQlAbstractTable($connection, DB_TABLE_TP_SERVICES);
		
		$this->addTableField('TS_Key', DB_COLUMN_NUMERIC, true);
		$this->addTableField('TS_TOKey', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_SVKey', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_Code', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_SubCode1', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_SubCode2', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_CNKey', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_CTKey', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_Day', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_Days', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_Men', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_Name');
		$this->addTableField('TS_OpPartnerKey', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_OpPacketKey', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_ATTRIBUTE', DB_COLUMN_NUMERIC);
		$this->addTableField('TS_TEMPGROSS');
		$this->addTableField('TS_CHECKMARGIN', DB_COLUMN_NUMERIC);
	}
	
	public function GetListDistinct($key) {
		$SQL = sprintf("SELECT TS_OpPartnerKey, TS_Name, TS_TOKey 
						FROM %s 
						WHERE TS_TOKey = ".$key."
						GROUP BY TS_OpPartnerKey, TS_Name, TS_TOKey;", $this->tableName);

		return $this->connection->ExecuteScalar($SQL, false);
	}
}