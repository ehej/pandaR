<?php
if (!defined('EVENT_FUNCTION_TAG')) {
	define('EVENT_FUNCTION_TAG', 'event');
}

Kernel::Import('system.page.component');
Kernel::Import('system.db.mysql.*');
Kernel::Import('system.db.mssql.*');
Kernel::Import('system.db.odbc.*');
Kernel::Import('system.http.session');
Kernel::Import('system.http.request');
Kernel::Import('system.data.datalayer');
Kernel::Import('system.response.nullresponse');

class Page extends Component {

	/**
	 *
	 * @var Request
	 */
	protected $request;
	/**
	 *
	 * @var AbstractResponse
	 */
	protected $response;
	/**
	 *
	 * @var Session
	 */
	protected $session;
	/**
	 *
	 * @var MySqlConnection
	 */
	protected $connection;
	/**
	 *
	 * @var MSSqlConnection
	 */
	protected $mssql_connection;
	protected $odbc_connection;
	/**
	 *
	 * @var DataLayer
	 */
	protected $document;
	public $Template;
	public $current_event;

	function __construct($Template) {
		$this->Template = $Template;
		$this->document = new DataLayer('page');
		$this->request = new Request();
		$this->session = new Session($this->getSessionID());
		$this->response = new NullResponse($this, $this->document);
		$this->openConnection();
	}

	function openConnection() {
		$this->connection = new MySQLConnection( MySQLConnectionProperties::createByURI(DB_URI) );
		$this->connection->properties->setEncoding( DB_CHARSET_UTF8 );
		$this->connection->Open();
		
		// $this->mssql_connection = new MSSQLConnection( MSSQLConnectionProperties::createByURI(DB_MSSQL_URI) );
		// $this->mssql_connection->properties->setEncoding( DB_CHARSET_UTF8 );
		// $this->mssql_connection->Open();
		
		// $this->odbc_connection = new odbcconnection( odbcconnectionproperties::createByURI(DB_ODBC_URI) );
		// $this->odbc_connection->properties->setEncoding( DB_CHARSET_UTF8 );
		// $this->odbc_connection->Open();
	}

	function authenticate() {
	}

	function index() {
	}

	function __destruct() {
		if (is_object($this->session)) $this->session->Close();
		if (is_object($this->connection)) $this->connection->Close();
		if (is_object($this->mssql_connection)) $this->mssql_connection->Close();
	}

	function getCurrentEvent() {
		return $this->current_event;
	}

	function processEvents() {
		$this->current_event = $this->request->Value(EVENT_FUNCTION_TAG);
		$this->processEvent($this->current_event);
	}

	function render() {}

	function terminatePage($die = true){
		if ($die) exit();
	}

	function getSessionID() {
		return null;
	}

	function getTemplatesRoot() {
		return $this->templatesRoot;
	}
	
	function setTemplatesRoot($troot = '') {
		$this->templatesRoot = $troot;
	}

	function getTemplate() {
		return $this->Template;
	}

	function setTemplate($template) {
		$this->Template = $template;
	}

	public function setResponse(AbstractResponse $responce) {
		$this->response = $responce;
	}

	public function getResponse() {
		return $this->response;
	}

	function setPage($templ) {
		$this->Template = $templ;
	}
	
	public function getUrlAlias(){
		$data['AdvCountries'] 		= $this->AdvCountriesTable->getListIDsUrl();
		$data['AdvResortsContent'] 	= $this->AdvResortsContentTable->getListIDsUrl();
		$data['AdvResorts'] 		= $this->AdvResortsTable->getListIDsUrl();
		$data['countries'] 			= $this->countriesTable->getListIDsUrl();
		$data['pages'] 				= $this->pagesTable->getListIDsUrl();
		$data['regions'] 			= $this->regionsTable->getListIDsUrl();
		$data['resorts'] 			= $this->ResortsTable->getListIDsUrl();
		$data['hotels'] 			= $this->hotelsTable->getListIDsUrl();
		$data['news_type'] 			= $this->NewsTypeTable->getListIDsUrl();
		$data['attractions'] 		= $this->AttractionsTable->getListIDsUrl();
		$data['other_info'] 		= $this->OtherInfoTable->getListIDsUrl();
		
		foreach ($data as $key => $value) {
			foreach ($value as $k => $v) {
				$tmp[$key][$v['identificator']] = $v;
			}
		}
		$data = $tmp;
		return $data;
	}
}
