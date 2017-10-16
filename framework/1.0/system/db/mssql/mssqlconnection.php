<?php
Kernel::Import("system.db.AbstractConnection");
Kernel::Import("system.db.mssql.MssqlDataReader");

class mssqlconnection Extends AbstructConnection {

	/**
	 *
	 * @var MsSQLConnectionProperties
	 */
	var $properties;

	function mssqlconnection($properties = null) {
		$this->properties = $properties;
	}

	function Open($isNewConnection=true) {
		$this->_Res = mssql_connect(
							$this->properties->getHost().':1433',
							$this->properties->getUser(),
							$this->properties->getPassword(),
							$isNewConnection ) or Kernel::RaiseError("Unable to make database connect");
		if ($this->_Res) {
			$this->State = DB_CONNECTION_STATE_CONNECTED;
			$this->ChangeDatabase($this->properties->getDatabase());
			//$this->ExecuteNonQuery('SET NAMES "' . $this->properties->encoding . '"');
			//$this->ExecuteNonQuery('SET CHARACTER SET "' . $this->properties->encoding . '"');
			//$this->ExecuteNonQuery('set collation_connection= "utf8_unicode_ci"');
			
			//$this->ExecuteNonQuery("set character_set_client='utf8'");
			//$this->ExecuteNonQuery("set character_set_results='utf8'");
			//$this->ExecuteNonQuery("set character_set_results='utf8'");
			return true;
		}
		return false;
	}

	function Close() {
		if ($this->State > DB_CONNECTION_STATE_CLOSED) {
			mssql_close($this->_Res);
			$this->State = DB_CONNECTION_STATE_CLOSED;
		}
	}

	function ChangeDatabase($database) {
		if ($this->State > DB_CONNECTION_STATE_CLOSED) {
			mssql_select_db($database, $this->_Res) or Kernel::RaiseError("Unable to select database '".$database."'");
			$this->State = DB_CONNECTION_STATE_OPENED;
			$this->properties->setDatabase($database);
			return true;
		}
		return false;
	}

	function ExecuteNonQuery($query) {
		if ($this->State == DB_CONNECTION_STATE_OPENED) {
			$this->allocate_mssql_query($query);
			return true;
		}
		return false;
	}

	function &ExecuteReader($query) {
		if ($this->State == DB_CONNECTION_STATE_OPENED) {
			$_res = $this->allocate_mssql_query($query);
			$MsSqlDataReader = new MssqlDataReader;
			if( $_res ) {
				$_num = mssql_num_rows($_res);
				$MsSqlDataReader->RecordCount = $_num;
				$MsSqlDataReader->FieldCount = mssql_num_fields($_res);
				$MsSqlDataReader->queryId = $_res;
				$MsSqlDataReader->state = DB_READER_STATE_OPENED;
			} else {
				$MsSqlDataReader->queryId = $_res;
				$MsSqlDataReader->RecordCount = 0;
				$MsSqlDataReader->FieldCount = 0;
				$MsSqlDataReader->mssql_error = mssql_get_last_message();
				$MsSqlDataReader->mssql_errno = mssql_get_last_message();
			}
			return $MsSqlDataReader;
		}
		return new MsSqlDataReader;
	}

	function ExecuteTable($query) {
		$reader = $this->ExecuteReader($query);
		$result = array();
		while( $item = $reader->Read() )
		{
			$result[] = $item;
		}
		return $result;
	}

	function allocate_mssql_query($query) {
		// в MSSQL нет аналога функции mssql_error(), поэтому заменил на mssql_get_last_message()
		$query = iconv('UTF-8', 'WINDOWS-1251', $query);
		$res = mssql_query($query, $this->_Res) or Kernel::RaiseError("MSSQL query '".trim($query)."' failed, because ".mssql_get_last_message());
		return $res;
	}
	
	function ExecuteScalar($query, $limited = true) {
		if ($this->State == DB_CONNECTION_STATE_OPENED) {
			$res = $this->allocate_mssql_query($query);
			if( $res ) {
				$num = mssql_num_rows($res);
				if ($num > 0) {
					if ($limited) {
						$ret = mssql_fetch_assoc($res);
					} else {
						while ($row = mssql_fetch_assoc($res)) {
							$ret[] = $row;
						}
					}
					return $ret;
				}
			}
		}
		return array();
	}
	
	function getDataSP($procedure , $parametr = false){
		
		if(!$procedure) return;

		if($parametr && is_array($parametr)){
			foreach ($parametr as $key => $value) {
				$param[] = ' '.$key.' = '.$value; 
			}
		}
		if (count($param)>0){
			$par = implode(' ', $param);
		}else{
			$par = '';
		}
		
		$sql = 'exec '.$procedure.' '.$par;
		if ($result = mssql_query($sql, $this->_Res) or Kernel::RaiseError("MSSQL query '".trim($sql)."' failed, because ".mssql_get_last_message())){
			while($row = mssql_fetch_assoc($result)){
				$res[] = $row;
			}
		}
		return $res;
	}


	function getDataSPtest($procedure){
		
		

		$sql = 'exec '.$procedure;
		if ($result = mssql_query($sql, $this->_Res) or Kernel::RaiseError("MSSQL query '".trim($sql)."' failed, because ".mssql_get_last_message())){
			while($row = mssql_fetch_assoc($result)){
			echo "1";
				$res[] = $row;
			}
		}
		return $res;
	}

}
