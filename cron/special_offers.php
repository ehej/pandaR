<?php
	date_default_timezone_set('Europe/Kiev');
	
// Settings and Constants block
	set_time_limit(0);
	ini_set('memory_limit', "32M");
	set_error_handler(create_function('$x, $y', 'throw new Exception($y, $x);'), E_ALL & ~E_NOTICE);

// Include block
	include_once(realpath(dirname(__FILE__)."/../classes/variables.php"));

	Kernel::Import('system.db.mysql.*');
	Kernel::Import("classes.data.SPOEditorsTable");
	Kernel::Import("classes.data.SpecialOffersTable");

function _log($msg, $die=false) {
	if ($die) {
		die($msg);
	} else {
		echo $msg."\n";
	}
}

class SpecialOffers {
	/**
	 * @var MySQLConnection
	 */
	private $connection;
	/**
	 * @var SPOEditorsTable
	 */
	public $SPOEditorsTable;
	/**
	 * @var SpecialOffersTable
	 */
	public $specialOffersTable;
	
	function __construct() {
		_log('Started at '.date('d.m.Y H:i:s'));

		$this->openConnection();

		$this->SPOEditorsTable = new SPOEditorsTable($this->connection);
		$this->specialOffersTable = new SpecialOffersTable($this->connection);
		
		// hidding SPO
		$spo = $this->SPOEditorsTable->GetList();
		foreach ($spo as $key => $value) {
			if ($value['varValidUntilDate'] < time() && $value['intHideAfterTheExpiration'] == 1) {
				$spo[$key]['isShow'] = 0;
				$this->SPOEditorsTable->Update($spo[$key]);
			}
		}
		
		// hidding special offers
		$so = $this->specialOffersTable->GetList();
		foreach ($so as $key => $value) {
			if ($value['varDateValid'] < time()) {
				$so[$key]['isShow'] = 0;
				$this->specialOffersTable->Update($so[$key]);
			}
		}
	}

	private function openConnection() {
		$this->connection = new MySQLConnection( MySQLConnectionProperties::createByURI(DB_URI) );
		$this->connection->properties->setEncoding( DB_CHARSET_UTF8 );
		$ret = $this->connection->Open();
		if (!$ret) throw new Exception('Can not connect to DB');
	}

}

try {
	$robot = new SpecialOffers();

	_log('OK'."<br />", true);
} catch (Exception $ex) {

	_log('ERROR '.$ex->getMessage()."<br />", true);
}