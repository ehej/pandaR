<?php
Kernel::Import("system.db.AbstructDataReader");

class odbcdatareader extends AbstructDataReader {

	function Read() {
		if (($this->state == DB_READER_STATE_OPENED) && ($this->Item = odbc_fetch_array($this->queryId))) {
			$this->currentRecord++;
			return $this->Item;
		} else {
			$this->state = DB_READER_STATE_CLOSED;
			return false;
		}
	}

}