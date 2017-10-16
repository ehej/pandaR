<?php

Kernel::Import("system.db.mssqlabstracttable");

class TblSpoDataTable extends MSSQlAbstractTable {

	function TblSpoDataTable(&$connection) {
		parent::MSSQlAbstractTable($connection, DB_TABLE_TBL_SPO_DATA);
		
		$this->addTableField('sd_key', DB_COLUMN_NUMERIC, true);
		$this->addTableField('sd_tourkey', DB_COLUMN_NUMERIC);
		$this->addTableField('sd_cnkey', DB_COLUMN_NUMERIC);
		$this->addTableField('sd_hdkey', DB_COLUMN_NUMERIC);
		$this->addTableField('sd_hdstars');
		$this->addTableField('sd_ctkey', DB_COLUMN_NUMERIC);
		$this->addTableField('sd_rskey', DB_COLUMN_NUMERIC);
		$this->addTableField('sd_tlkey', DB_COLUMN_NUMERIC);
		$this->addTableField('sd_ctkeyfrom', DB_COLUMN_NUMERIC);
		$this->addTableField('sd_ctkeyto', DB_COLUMN_NUMERIC);
		$this->addTableField('sd_tourtype', DB_COLUMN_NUMERIC);
		$this->addTableField('sd_pnkey', DB_COLUMN_NUMERIC);
		$this->addTableField('sd_isenabled', DB_COLUMN_NUMERIC);
		$this->addTableField('sd_tourcreated');
		$this->addTableField('sd_main', DB_COLUMN_NUMERIC);
		$this->addTableField('sd_cnname');
		$this->addTableField('sd_tourname');
		$this->addTableField('sd_hdname');
		$this->addTableField('sd_ctname');
		$this->addTableField('sd_rsname');
		$this->addTableField('sd_ctfromname');
		$this->addTableField('sd_cttoname');
		$this->addTableField('sd_tourtypename');
		$this->addTableField('sd_pncode');
		$this->addTableField('sd_hotelkeys');
		$this->addTableField('sd_pansionkeys');
		$this->addTableField('sd_tourvalid');
		$this->addTableField('sd_hotelurl');
	}
	
	public function GetListDistinct() {
		$SQL = sprintf("SELECT sd_tourkey, sd_tourname, sd_cnkey, sd_ctkeyfrom FROM %s GROUP BY sd_tourkey, sd_tourname, sd_cnkey, sd_ctkeyfrom;", $this->tableName);

		return $this->connection->ExecuteScalar($SQL, false);
	}
}