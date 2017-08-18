<?php

Kernel::Import("system.db.abstracttable");

class ToursTable extends AbstractTable {

	function ToursTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_TOURS);
		$this->addTableField('intTourID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varName');
		$this->addTableField('varUrlAlias');
		$this->addTableField('varShortDescription');
		$this->addTableField('varDescription');
		$this->addTableField('varDescriptionBottom');
		$this->addTableField('varComment');
		$this->addTableField('varDateFrom');
		$this->addTableField('varDateTo');
		$this->addTableField('intPriceFrom', DB_COLUMN_NUMERIC);
		$this->addTableField('intPriceTo', DB_COLUMN_NUMERIC);
		$this->addTableField('intRegionID', DB_COLUMN_NUMERIC);
		$this->addTableField('isVisible', DB_COLUMN_NUMERIC);
		$this->addTableField('isSpecial', DB_COLUMN_NUMERIC);
		$this->addTableField('intCountDays', DB_COLUMN_NUMERIC);
		// $this->addTableField('intCountPeoples', DB_COLUMN_NUMERIC);
		$this->addTableField('intHotelID', DB_COLUMN_NUMERIC);
		// $this->addTableField('intResortID', DB_COLUMN_NUMERIC);
		$this->addTableField('intCurrencyID', DB_COLUMN_NUMERIC);
		// $this->addTableField('varTransport');
		$this->addTableField('varFile1');
		$this->addTableField('varFile2');
		$this->addTableField('varFile3');
		$this->addTableField('varRealFile1Name');
		$this->addTableField('varRealFile2Name');
		$this->addTableField('varRealFile3Name');
		$this->addTableField('varAgencyComission');
		$this->addTableField('varAgencyDescription');
		$this->addTableField('varHeat');
		$this->addTableField('varStatement');
		$this->addTableField('varDays');
		$this->addTableField('isIndex', DB_COLUMN_NUMERIC);
	}

	public static function GetTransport() {
		return array(
			'plane'=>'Самолёт',
			'train'=>'Поезд',
			'bus'=>'Автобус',
			'steamer'=>'Пароход'
		);
	}

	function &GetListWithNames($data = null, $orders = null, $limitCount = null, $limitOffset = null) {
		$whereClause = $groupClause = "";

		if (!is_null($data)) {
			foreach ($this->columns as $column) {
				if (isset($data[$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= "t.".$column["name"] . "=" . AbstractTable::prepareColumnValue($column, $data[$column["name"]]);
				}
				if (!empty($data['LIKE'.$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= "t.".$column["name"] . " LIKE(" . AbstractTable::prepareColumnValue($column, '%'.$data['LIKE'.$column["name"]].'%') . ")";
				}
				if (!empty($data['FROM'.$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= "t.".$column["name"] . " >= " . AbstractTable::prepareColumnValue($column, $data['FROM'.$column["name"]]) . "";
				}
				if (!empty($data['TO'.$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= "t.".$column["name"] . " <= " . AbstractTable::prepareColumnValue($column, $data['TO'.$column["name"]]) . "";
				}
			}
		}

		if(isset($data['intResortID']) && !empty($data['intResortID'])) {
			if (strlen($whereClause)) $whereClause .= " AND "; $whereClause .= "rr.intResortID=". $data['intResortID'];
		}
		if(isset($data['intTypeID']) && !empty($data['intTypeID'])) {
			if (strlen($whereClause)) $whereClause .= " AND "; $whereClause .= "ttt.intTypeID=". $data['intTypeID'];
		}
		if(isset($data['intCountryID']) && !empty($data['intCountryID'])) {
			if (strlen($whereClause)) $whereClause .= " AND "; $whereClause .= "ss.intCountryID=". $data['intCountryID'];
		}
		if(isset($data['varTransport']) && !empty($data['varTransport'])) {
			if (strlen($whereClause)) $whereClause .= " AND "; $whereClause .= "tr.varTransport='". $data['varTransport']."'";
		}
		
		if(isset($data['OrderBy'])=='country') {
			$groupClause = "GROUP by intTourID, ss.intCountryID";
		} else {
			$groupClause = "GROUP by intTourID, tt.intTypeID";
		}
		
		$whereClause = strlen( $whereClause ) ? " WHERE " . $whereClause : "";

		$orderClause = "";
		if (is_array($orders)) {
			$keys = array_keys($orders);
			foreach ($keys as $key) {
				if (strlen($orderClause)) {
					$orderClause .= ", ";
				}
				if($key != 'varCountryName' && $key != 'varTypeName') {
					$prefix = 't.';
				}
				$orderClause = $orderClause . $prefix.$key . " ".$orders[$key];
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
		/* TODO
			//GROUP_CONCAT(DISTINCT pt.varName ORDER by pt.varName SEPARATOR ', ') as varFoodTypeName,
			//GROUP_CONCAT(DISTINCT c.varName ORDER by c.varName SEPARATOR ', ') as varHotelName,
			//GROUP_CONCAT(DISTINCT r.varName ORDER by r.varName SEPARATOR ', ') as varResortName,
			//GROUP_CONCAT(DISTINCT tr.varTransport ORDER by tr.varTransport SEPARATOR ', ') as varTransport,
			//GROUP_CONCAT(DISTINCT ft.varName ORDER by ft.varName SEPARATOR ', ') as varPlaceTypeName,
		 * 
		 */
		$SQL = sprintf("
			SELECT SQL_CALC_FOUND_ROWS t.intTourID,
			t.varName,
			t.intTypeID,
			t.intCountryID,
			t.varDateFrom,
			t.varDateTo,
			t.intPriceFrom,
			t.isSpecial,
			t.isVisible,
			t.isIndex,
			tt.varName AS varTypeName,
			s.varName AS varCountryName
			FROM %s AS t
			LEFT JOIN %s AS v USING (intCurrencyID)
			LEFT JOIN %s ttt USING (intTourID)
			LEFT JOIN %s tt ON (tt.intTypeID = ttt.intTypeID)
			LEFT JOIN %s ss USING (intTourID)
			LEFT JOIN %s s ON (s.intCountryID = ss.intCountryID)
		%s %s %s %s", 
		$this->tableName, 
		DB_TABLE_CURRENCIES,
		DB_TABLE_TOURS_TYPES,
		DB_TABLE_TOURTYPES,
		DB_TABLE_TOURS_COUNTRIES,
		DB_TABLE_COUNTRIES,
		$whereClause, 
		$groupClause,
		$orderClause, 
		$limitClause
		);
		
		@$reader = &$this->connection->ExecuteReader($SQL);
		return $reader;
	}
	
		function &GetListWithNamesPublic($data = null, $orders = null, $limitCount = null, $limitOffset = null) {
		$whereClause = $groupClause = "";
		if (!is_null($data)) {
			foreach ($this->columns as $column) {
				if (isset($data[$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= "t.".$column["name"] . "=" . AbstractTable::prepareColumnValue($column, $data[$column["name"]]);
				}
				if (!empty($data['LIKE'.$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= "t.".$column["name"] . " LIKE(" . AbstractTable::prepareColumnValue($column, '%'.$data['LIKE'.$column["name"]].'%') . ")";
				}
				if (!empty($data['FROM'.$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= "t.".$column["name"] . " >= " . AbstractTable::prepareColumnValue($column, $data['FROM'.$column["name"]]) . "";
				}
				if (!empty($data['TO'.$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= "t.".$column["name"] . " <= " . AbstractTable::prepareColumnValue($column, $data['TO'.$column["name"]]) . "";
				}
			}
		}

		if(isset($data['intResortID']) && !empty($data['intResortID'])) {
			if (strlen($whereClause)) $whereClause .= " AND "; $whereClause .= "rr.intResortID=". $data['intResortID'];
		}
		if(isset($data['intTypeID']) && !empty($data['intTypeID'])) {
			if (strlen($whereClause)) $whereClause .= " AND "; $whereClause .= "ttt.intTypeID=". $data['intTypeID'];
		}
		if(isset($data['intCountryID']) && !empty($data['intCountryID'])) {
			if (strlen($whereClause)) $whereClause .= " AND "; $whereClause .= "ss.intCountryID=". $data['intCountryID'];
		}
		if(isset($data['varTransport']) && !empty($data['varTransport'])) {
			if (strlen($whereClause)) $whereClause .= " AND "; $whereClause .= "tr.varTransport='". $data['varTransport']."'";
		}
		if(isset($data['varResortName']) && !empty($data['varResortName'])) {
			if (strlen($whereClause)) $whereClause .= " AND "; $whereClause .= "r.varName='". $data['varResortName']."'";
		}
		
		if(isset($data['OrderBy'])=='country') {
			$groupClause = "GROUP by intTourID, ss.intCountryID";
		} else {
			$groupClause = "GROUP by intTourID, tt.intTypeID";
		}
		$whereClause = " WHERE DATE(t.varDateTo) >= '".date('Y-m-d')."'".((strlen($whereClause)) ? " AND ".$whereClause : '');

		$orderClause = "";
		if (is_array($orders)) {
			$keys = array_keys($orders);
			foreach ($keys as $key) {
				if (strlen($orderClause)) {
					$orderClause .= ", ";
				}
				if($key != 'varCountryName' && $key != 'varTypeName') {
					$prefix = 't.';
				}
				$orderClause = $orderClause . $prefix.$key . " ".$orders[$key];
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
		/* TODO
			//GROUP_CONCAT(DISTINCT pt.varName ORDER by pt.varName SEPARATOR ', ') as varFoodTypeName,
			//GROUP_CONCAT(DISTINCT c.varName ORDER by c.varName SEPARATOR ', ') as varHotelName,
			//GROUP_CONCAT(DISTINCT r.varName ORDER by r.varName SEPARATOR ', ') as varResortName,
			//GROUP_CONCAT(DISTINCT tr.varTransport ORDER by tr.varTransport SEPARATOR ', ') as varTransport,
			//GROUP_CONCAT(DISTINCT ft.varName ORDER by ft.varName SEPARATOR ', ') as varPlaceTypeName,
		 * 
		 */

		$SQL = sprintf("
			SELECT SQL_CALC_FOUND_ROWS t.*,
			tt.varName AS varTypeName,
			s.varName AS varCountryName,
			r.varName AS varResortName,
			s.varUrlAlias as tourCountryUri,
			v.varMark
			FROM %s AS t
			LEFT JOIN %s AS v USING (intCurrencyID)
			LEFT JOIN %s ttt USING (intTourID)
			LEFT JOIN %s tt ON (tt.intTypeID = ttt.intTypeID)
			LEFT JOIN %s ss USING (intTourID)
			LEFT JOIN %s s ON (s.intCountryID = ss.intCountryID)
			LEFT JOIN %s AS rr USING (intTourID)
			LEFT JOIN %s AS r ON (r.intResortID = rr.intResortID)
			LEFT JOIN %s AS cc USING (intTourID)
			LEFT JOIN %s AS c ON (c.intHotelID = cc.intHotelID)
			LEFT JOIN %s AS ptt USING (intTourID)
			LEFT JOIN %s AS pt ON (pt.intFoodTypeID = ptt.intFoodTypeID)
			LEFT JOIN %s AS ftt USING (intTourID)
			LEFT JOIN %s AS ft ON (ft.intPlaceTypeID = ftt.intPlaceTypeID)
			LEFT JOIN %s AS tr USING (intTourID)
			LEFT JOIN %s AS pct USING (intTourID)
		%s %s %s %s", 
		$this->tableName, 
		DB_TABLE_CURRENCIES,
		DB_TABLE_TOURS_TYPES,
		DB_TABLE_TOURTYPES,
		DB_TABLE_TOURS_COUNTRIES,
		DB_TABLE_COUNTRIES,
		DB_TABLE_TOURS_RESORTS,
		DB_TABLE_RESORTS,
		DB_TABLE_TOURS_HOTELS,
		DB_TABLE_HOTELS,
		DB_TABLE_TOURS_FOODTYPES,
		DB_TABLE_FOODTYPES,
		DB_TABLE_TOURS_PLACEMENT,
		DB_TABLE_PLACETYPES,
		DB_TABLE_TOURS_TRANSPORT,
		DB_TABLE_TOURS_COUNTPEOPLES,
		$whereClause, 
		$groupClause,
		$orderClause, 
		$limitClause
		);

		@$reader = &$this->connection->ExecuteReader($SQL);
		return $reader;
	}
	
	function &getListWithCountries($data = null, $orders = null, $limitCount = 4, $limitOffset = null) {
		$whereClause = "";
		if (!is_null($data)) {
			foreach ($this->columns as $column) {
				if (isset($data[$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= "t.".$column["name"] . "=" . AbstractTable::prepareColumnValue($column, $data[$column["name"]]);
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
				$orderClause = $orderClause . "t.".$key . " ".$orders[$key];
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
		$SQL = sprintf("SELECT SQL_CALC_FOUND_ROWS t.* ,
		c.varName AS varCountryName,
		c.varLogo AS varCountryLogo  
		FROM %s AS t 
		LEFT JOIN %s AS c ON c.intCountryID = t.intCountryID %s %s %s", $this->tableName, DB_TABLE_COUNTRIES, $whereClause, $orderClause, $limitClause);
		@$reader = &$this->connection->ExecuteReader($SQL);
		return $reader;
	}

	function &getListWithCountriesExt($data = null, $orders = null, $limitCount = null, $limitOffset = null) {
		$whereClause = "";
		if (!is_null($data)) {
			foreach ($this->columns as $column) {
				if (isset($data[$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= "t.".$column["name"] . "=" . AbstractTable::prepareColumnValue($column, $data[$column["name"]]);
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
				$orderClause = $orderClause . "t.".$key . " ".$orders[$key];
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
		$SQL = sprintf("SELECT SQL_CALC_FOUND_ROWS t.*, c.intCountryID AS intCountryID, c.varName AS varCountryName, c.varLogo AS varCountryLogo  
						FROM %s AS t 
						LEFT JOIN %s AS c ON c.intCountryID = t.intCountryID %s %s %s", $this->tableName, DB_TABLE_COUNTRIES, $whereClause, $orderClause, $limitClause);
		@$reader = &$this->connection->ExecuteReader($SQL);
		return $reader;
	}
	
	public function getToursExt($countryName)
	{
		$SQL	=	sprintf("	SELECT SQL_CALC_FOUND_ROWS t.*,	c.varName AS varCountryName, tp.varName	AS varTypeName,	r.varName AS varRegionName
								FROM %s AS t, %s AS c, %s AS tp, %s AS r
								WHERE t.intTypeID = tp.intTypeID AND t.intCountryID =	c.intCountryID AND t.intRegionID = r.intRegionID AND c.varName = '".$countryName."' AND t.isVisible	= '1';"
							,	DB_TABLE_TOURS,	DB_TABLE_COUNTRIES,	DB_TABLE_TOURTYPES,	DB_TABLE_REGIONS);

		return $this->connection->ExecuteTable($SQL);
	}
}

class ToursCountriesTable extends AbstractTable {

	function ToursCountriesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_TOURS_COUNTRIES);
		$this->addTableField('intTourID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intCountryID', DB_COLUMN_NUMERIC, true);
	}
}
class ToursHotelsTable extends AbstractTable {

	function ToursHotelsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_TOURS_HOTELS);
		$this->addTableField('intTourID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intHotelID', DB_COLUMN_NUMERIC, true);
	}
}
class ToursTypesTable extends AbstractTable {

	function ToursTypesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_TOURS_TYPES);
		$this->addTableField('intTourID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intTypeID', DB_COLUMN_NUMERIC, true);
	}
}
class ToursTransportTable extends AbstractTable {

	function ToursTransportTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_TOURS_TRANSPORT);
		$this->addTableField('intTourID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('varTransport', DB_COLUMN_STRING, true);
	}
	function getByTour($ID = null){
		if(!$ID) return;
		$SQL = sprintf('SELECT varTransport FROM %s WHERE intTourID=%d GROUP BY varTransport ORDER BY varTransport',$this->tableName, $ID);
		$res = $this->connection->ExecuteScalar($SQL,false);
		$result = array();
		foreach($res as $row) {
			$result[] = $row['varTransport'];
		}
		return $result;
	}
}
class ToursResortsTable extends AbstractTable {

	function ToursResortsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_TOURS_RESORTS);
		$this->addTableField('intTourID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intResortID', DB_COLUMN_STRING, true);
	}
}
class ToursPlacementTable extends AbstractTable {

	function ToursPlacementTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_TOURS_PLACEMENT);
		$this->addTableField('intTourID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intPlaceTypeID', DB_COLUMN_STRING, true);
	}
}
class ToursFoodTable extends AbstractTable {

	function ToursFoodTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_TOURS_FOODTYPES);
		$this->addTableField('intTourID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intFoodTypeID', DB_COLUMN_STRING, true);
	}
}
class ToursCountPeoplesTable extends AbstractTable {

	function ToursCountPeoplesTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_TOURS_COUNTPEOPLES);
		$this->addTableField('intCountPeoplesID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intTourID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intCountPeoples', DB_COLUMN_NUMERIC);
	}
}