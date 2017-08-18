<?php

class Logger {
	static private $instance = NULL;
	private $fp = NULL;

	static function getInstance($logname = '') {
		if (self::$instance == NULL) {
			$logn='admin';
			if (!empty($logname)) $logn = $logname;
			self::$instance = new Logger($logn);
		}
		return self::$instance;
	}

	private function __construct($logname) {
		$this->fp = @fopen(LOG_USERS_ACTION_PATH . $GLOBALS['_log']['userid'] . LOG_USERS_ACTION_EXT, 'a');
	}
	public function __destruct() {
		@fclose($this->fp);
	}
	private function __clone() {
	}

	public function writeUser($msg) {
		if (LOG_USERS_ACTION && $GLOBALS['_log']['userid']) {
			$content = sprintf("[%s] %s (%s)\n",
								date('dmy H:i:s'),
								$msg,
								$_SERVER['REQUEST_METHOD'] . ' ' . $_SERVER['REQUEST_URI']);								
			@fwrite($this->fp, $content);
		}
	}

}

// user logger
function _log_set_user($userid) {
	$GLOBALS['_log']['userid'] = $userid;
}

function _log($msg) {
	if (LOG_USERS_ACTION && $GLOBALS['_log']['userid']) {
		$logger = Logger::getInstance();
		$logger->writeUser($msg);
	}
}