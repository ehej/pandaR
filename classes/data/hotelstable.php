<?php

Kernel::Import("system.db.abstracttable");

class HotelsTable extends AbstractTable {

	function HotelsTable(&$connection) {
		parent::AbstractTable($connection, DB_TABLE_HOTELS);
		
		$this->addTableField('intHotelID', DB_COLUMN_NUMERIC, true);
		$this->addTableField('intRegionID', DB_COLUMN_NUMERIC);	
		$this->addTableField('intCountryID', DB_COLUMN_NUMERIC);	
		$this->addTableField('intResortID', DB_COLUMN_NUMERIC);	
		$this->addTableField('varName');
		$this->addTableField('varLogo');
		$this->addTableField('varRealLogoName');
		$this->addTableField('varMetaTitle');
		$this->addTableField('varMetaKeywords');
		$this->addTableField('varMetaDescription');	
		$this->addTableField('varDescription');
		$this->addTableField('intMTHotels', DB_COLUMN_NUMERIC);	
		$this->addTableField('varShowComments');
		$this->addTableField('varCountStars');
		$this->addTableField('isActive', DB_COLUMN_NUMERIC);
		$this->addTableField('MTHotelID', DB_COLUMN_NUMERIC);
		$this->addTableField('MTCountryID', DB_COLUMN_NUMERIC);
		$this->addTableField('intFoodBB', DB_COLUMN_NUMERIC);
		$this->addTableField('intFoodHB', DB_COLUMN_NUMERIC);
		$this->addTableField('intFoodFB', DB_COLUMN_NUMERIC);
		$this->addTableField('intFoodAI', DB_COLUMN_NUMERIC);
		$this->addTableField('intFoodOB', DB_COLUMN_NUMERIC);
		$this->addTableField('intVIP', DB_COLUMN_NUMERIC);
		$this->addTableField('varPriceAt');
		$this->addTableField('intHotelTypeID', DB_COLUMN_NUMERIC);
		$this->addTableField('intFoodTypeID', DB_COLUMN_NUMERIC);
		$this->addTableField('intPlaceTypeID', DB_COLUMN_NUMERIC);
		$this->addTableField('varUrlAlias');
		$this->addTableField('intCurrencyID', DB_COLUMN_NUMERIC);
	}
	
	public function getListIDsNames() {
		$SQL = sprintf('SELECT intHotelID, intRegionID, varName, intMTHotels
						FROM %s;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
	
	public function getListIDsNamesSite() {
		$SQL = sprintf('SELECT intHotelID, intRegionID, varName, intMTHotels
						FROM %s WHERE isActive = 1 AND varUrlAlias <> "" AND intRegionID <> 0 AND intCountryID <> 0 ;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
	
	public function getListIDsNamesByRegionID($intRegionID) {
		$SQL = sprintf('SELECT * 
						FROM %s 
						WHERE intRegionID = '.$intRegionID.'
						ORDER BY varName;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
	public function getListIDsNamesByResortID($intResortID) {
		$SQL = sprintf('SELECT * 
						FROM %s 
						WHERE intResortID = '.$intResortID.'
						ORDER BY varName;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
	
	public function getListIDsUrl() {
		$SQL = sprintf('SELECT intHotelID as identificator, varUrlAlias
						FROM %s;', $this->tableName);
		return $this->connection->ExecuteScalar($SQL, false);
	}
	
	function getByTour($ID = null){
		if(!$ID) return;
		$SQL = sprintf('SELECT varName FROM %s p JOIN %s a USING(intHotelID) WHERE a.intTourID=%d GROUP BY p.intHotelID ORDER BY varName',$this->tableName, DB_TABLE_TOURS_HOTELS, $ID);
		$res = $this->connection->ExecuteScalar($SQL,false);
		$result = array();
		foreach($res as $row) {
			$result[] = $row['varName'];
		}
		return $result;
	}
	
	function &GetWithOrder($data = null, $orders = null, $limitCount = null, $limitOffset = null) {
		$whereClause = "";
		if (!is_null($data)) {
			foreach ($this->columns as $column) {
				if (isset($data[$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= 'n.'.$column["name"] . "=" . AbstractTable::prepareColumnValue($column, $data[$column["name"]]);
				} elseif (!empty($data['LIKE'.$column["name"]])) {
					if (strlen($whereClause)) $whereClause .= " AND ";
					$whereClause .= 'n.'.$column["name"] . " LIKE(" . AbstractTable::prepareColumnValue($column, '%'.$data['LIKE'.$column["name"]].'%') . ")";
				}
			}
		}
		if (isset($data['nameCountry']) && !empty($data['nameCountry'])) {
			if (!empty($whereClause)) $whereClause .= " AND ";
			$whereClause .= "country.varName = ".$data['nameCountry'];
		}
		if (isset($data['nameRegion']) && !empty($data['nameRegion'])) {
			if (!empty($whereClause)) $whereClause .= " AND ";
			$whereClause .= "region.varName = ".$data['nameRegion'];
		}
		if (isset($data['nameResort']) && !empty($data['nameResort'])) {
			if (!empty($whereClause)) $whereClause .= " AND ";
			$whereClause .= "resort.varName = ".$data['nameResort'];
		}
		if (strlen($whereClause)) $whereClause = " WHERE " . $whereClause;
		$orderClause = "";
		if (is_array($orders)) {
			$keys = array_keys($orders);
			foreach ($keys as $key) {
				if (strlen($orderClause)) {
					$orderClause .= ", ";
				}
				if($key == 'nameCountry'){
					$orderClause = $orderClause . 'country.varName' . " ".$orders[$key];
				}elseif($key == 'nameRegion'){
					$orderClause = $orderClause . 'region.varName' . " ".$orders[$key];
				}elseif($key == 'nameResort'){
					$orderClause = $orderClause . 'resort.varName' . " ".$orders[$key];
				}else{
					$orderClause = $orderClause . $key . " ".$orders[$key];
				}
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
		$SQL = sprintf("SELECT SQL_CALC_FOUND_ROWS n.*, country.varName as nameCountry, region.varName as nameRegion, resort.varName as nameResort
						FROM %s as n
						LEFT JOIN %s as country ON n.intCountryID = country.intCountryID
						LEFT JOIN %s as region ON n.intRegionID = region.intRegionID
						LEFT JOIN %s as resort ON n.intResortID = resort.intResortID
						%s%s%s", $this->tableName, DB_TABLE_COUNTRIES, DB_TABLE_REGIONS, DB_TABLE_RESORTS,$whereClause, $orderClause, $limitClause);

		@$reader = &$this->connection->ExecuteReader($SQL);
		return $reader;
	}

}
