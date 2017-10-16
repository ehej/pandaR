<?php
Kernel::Import("system.db.AbstractConnection");
Kernel::Import("system.db.odbc.odbcDataReader");

class odbcconnection Extends AbstructConnection {

	/**
	 *
	 * @var odbcConnectionProperties
	 */
	var $properties;

	function odbcconnection($properties = null) {
		$this->properties = $properties;
	}

	function Open($isNewConnection=true) {
		
		$this->_Res = odbc_connect(
							$this->properties->getPath(),
							$this->properties->getUser(),
							$this->properties->getPassword(),
							SQL_CUR_USE_ODBC) or Kernel::RaiseError("Unable to make database connect");
		if ($this->_Res) {
				$this->State = DB_CONNECTION_STATE_OPENED;
				//$this->ChangeDatabase($this->properties->getDatabase());
				return true;
		}
		return false;
	}

	function Close() {
		if ($this->State > DB_CONNECTION_STATE_CLOSED) {
			odbc_close($this->_Res);
			$this->State = DB_CONNECTION_STATE_CLOSED;
		}
	}

	function ExecuteNonQuery($query) {
		if ($this->State == DB_CONNECTION_STATE_OPENED) {
			$this->allocate_odbc_query($query);
			return true;
		}
		return false;
	}

	function allocate_odbc_query($query) {
		$query = iconv('UTF-8', 'WINDOWS-1251', $query);
		$res = odbc_exec($this->_Res, $query ) or Kernel::RaiseError("ODBC query '".trim($query)."' failed, because ".odbc_error($this->_Res));
		return $res;
	}
	
	function ExecuteScalar($query, $limited = true) {
		if ($this->State == DB_CONNECTION_STATE_OPENED) {
			$res = $this->allocate_odbc_query($query);
			if( $res ) {
				if ($limited) {
					$ret = odbc_fetch_array($res);
				} else {
					while ($row = odbc_fetch_array($res)) {
						$ret[] = $row;
					}
				}

				return $ret;
			}
		}
		return array();
	}
	
	function getDataSP($procedure , $parametr = false){
		
		if(!$procedure) return;

		if($parametr && is_array($parametr)){
			foreach ($parametr as $key => $value) {
				$param[] = ' @'.$key.' = \''.$value.'\''; 
			}
		}
		if (count($param)>0){
			$par = implode(', ', $param);
		}else{
			$par = '';
		}
		$sql = 'exec '.$procedure.' '.$par;
		$res = $this->ExecuteScalar($sql, false);
		return $res;
	}
}
