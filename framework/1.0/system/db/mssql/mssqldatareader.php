<?php
Kernel::Import("system.db.AbstructDataReader");

class mssqldatareader extends AbstructDataReader {

	function Read() {
		if (($this->state == DB_READER_STATE_OPENED) && ($this->Item = mssql_fetch_array($this->queryId, MSSQL_ASSOC))) {
			$this->currentRecord++;
			return $this->Item;
		} else {
			$this->state = DB_READER_STATE_CLOSED;
			return false;
		}
	}

}