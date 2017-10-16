<?php

include_once(realpath(dirname(__FILE__)."/../variables.php"));

Kernel::Import("system.page.Page");
Kernel::Import('system.response.SmartyResponse');
Kernel::Import('classes.data.AdminsTable');
Kernel::Import("classes.data.CommentsTable");
Kernel::Import('classes.logger.*');
Kernel::Import("classes.data.RolesTable");
Kernel::Import("classes.unit.LinkCreator");

Kernel::Import("classes.data.CountriesTable");
Kernel::Import("classes.data.RegionsTable");
Kernel::Import("classes.data.HotelsTable");
Kernel::Import("classes.data.ResortsTable");
Kernel::Import("classes.data.PagesTable");
Kernel::Import("classes.data.AdvCountriesTable");
Kernel::Import("classes.data.AdvResortsTable");
Kernel::Import("classes.data.AdvResortsContentTable");
Kernel::Import("classes.data.NewsTypeTable");
Kernel::Import("classes.data.AttractionsTable");
Kernel::Import("classes.data.OtherInfoTable");

class AdminPage extends Page {

	/**
	 * @var AdminsTable
	 */
	public $adminsTable;
	/**
	 * @var CommentsTable
	 */
	public $commentsTable;
	/**
	 * @var RolesTable
	 */
	var $rolesTable;
	
	/**
	 * @var CountriesTable
	 */
	var $countriesTable;
	/**
	 * @var RegionsTable
	 */
	var $regionsTable;
	/**
	 * @var ResortsTable
	 */
	var $ResortsTable;
	/**
	 * @var HotelsTable
	 */
	var $hotelsTable;
	 /**
	 * @var StaticZonePositionable
	 */
	var $StaticZonePositionTable;
	/**
	 * @var AdvCountriesTable
	 */
	var $AdvCountriesTable;
	/**
	 * @var AdvResortsTable
	 */
	var $AdvResortsTable;
	/**
	 *
	 * @var NewsTypeTable
	 */
	var $NewsTypeTable;
	var $AttractionsTable;
	var $OtherInfoTable;
	
	
	var $countNewItems = 0;
	public $all_alias;

	function __construct($Template) {
		parent::__construct($Template);

		$this->setResponse(new SmartyResponse($this, $this->document));
		$this->adminsTable 					= new AdminsTable($this->connection);
		$this->commentsTable 				= new CommentsTable($this->connection);
		$this->rolesTable 					= new RolesTable($this->connection);
		$this->NewsTypeTable 				= new NewsTypeTable($this->connection);
		$this->countriesTable 				= new CountriesTable($this->connection);
		$this->pagesTable 					= new PagesTable($this->connection);
		$this->regionsTable 				= new RegionsTable($this->connection);
		$this->ResortsTable 				= new ResortsTable($this->connection);
		$this->hotelsTable 					= new HotelsTable($this->connection);
		$this->AdvCountriesTable			= new AdvCountriesTable($this->connection);
		$this->AdvResortsTable 				= new AdvResortsTable($this->connection);
		$this->AdvResortsContentTable 		= new AdvResortsContentTable($this->connection);
		$this->AttractionsTable				= new AttractionsTable($this->connection);
		$this->OtherInfoTable 				= new OtherInfoTable($this->connection);
		
		$this->setTemplatesRoot('admin/');
		$comments = $this->commentsTable->GetList(array('varIsNew' => 'yes'));
		$this->countNewItems = count($comments);
		$this->all_alias = $this->getUrlAlias();
	}

	function authenticate() {
		$admin['intAdminID'] = $this->session->Get('ADMIN_DATA');
		if (empty($admin['intAdminID'])) {
			$this->OnLogout($_SERVER["REQUEST_URI"]);
		}
		_log_set_user($admin['intAdminID']);
		_log('Browse page');
		
		$this->document->addValue('DEFAULT_SUPER_ADMIN_ID', DEFAULT_SUPER_ADMIN_ID);
		$this->document->addValue('ADMIN_DATA', $this->session->Get('ADMIN_DATA'));
		
		$data = $this->session->Get('ADMIN_ROLES');

		$this->document->addValue('adminPrivileges', unserialize($data['varPriveleges']));
		$fileName = basename($_SERVER['SCRIPT_NAME'], '.php');
		if (strripos($fileName, '.edit') !== false)  $fileName = substr($fileName, 0, strripos($fileName, '.edit'));

		if(!in_array($fileName, unserialize($data['varPriveleges'])) && $admin['intRoleID']==SUPER_ADMIN_ROLE) {
			$this->setTemplate('access_denied.tpl');
		}
		// $this->response->redirect('/admin/');
	}
	function checkSuperAdmin() {
		$adminData = $this->session->Get('ADMIN_DATA');
		//if($adminData['intAdminID'] != DEFAULT_SUPER_ADMIN_ID) $this->setTemplate('access_denied.tpl'); //$this->response->redirect('/admin/');
		if($adminData['intRoleID'] != SUPER_ADMIN_ROLE) $this->setTemplate('access_denied.tpl');
	}
	function OnLogon() {
		$this->session->Clear();
		
		$login = $this->request->getString('login');
		$password = $this->request->getString('password');
		$admin = $this->adminsTable->GetByFields(array('varLogin'=>$login));
		if (count($admin) && md5($password) === $admin['varPassword']) {
			$this->session->Set('ADMIN_DATA', $admin);
			$this->session->Set('ADMIN_ROLES', $this->rolesTable->Get(array('intRoleID' => $admin['intRoleID'])));
			// check if there are some target for redirection
			$target = base64_decode($this->request->getString('q'));
			if (!empty($target)) {
				$this->response->redirect($target);
			} else {
				$this->response->redirect('/admin/');
			}
		} else {
			$this->addErrorMessage('Ошибка аутентификации');
		}
		return;
	}
	
	function OnLogout($target = null) {
		$this->session->Clear();

		if (!is_null($target)) {
			$this->response->redirect('logon.php?q='.base64_encode($target));
			_log('Unauthorized access to '.$target.', logout');
		} else {
			_log('Logout done');
			$this->response->redirect('logon.php');
		}
	}

	function getLog($intAdminID) {
		// read user log
		$cmd = 'tail -n 15 '.LOG_USERS_ACTION_PATH.$intAdminID.LOG_USERS_ACTION_EXT;
		exec($cmd, $contents);
		return implode("\n", $contents);
	}
	
	function getAdminID() {
		$admin = $this->session->Get('ADMIN_DATA');
		return (int) $admin['intAdminID'];
	}

	function setBoldMenu($menu) {
		$this->document->addValue('boldMenu', $menu);
	}

	function addErrorMessage($message) {
		$this->addMessage($message, true);
	}

	function addMessage($message, $error = false) {
		$messages = $this->session->Get('messages');
		$messages = is_null($messages)? array() : $messages;
		$messages[] = array('msg' => $message, 'error' => $error);
		$this->session->Set('messages', $messages);
	}

	function hasErrorMessages() {
		$messages = $this->session->Get('messages');
		$messages = is_null($messages)? array() : $messages;
		foreach ($messages as $msg) {
			if ($msg['error']) return true;
		}
		return false;
	}

	function writeMessages() {
		$messages = $this->session->Get('messages');
		if( is_array($messages) && count($messages) ) {
			$this->document->addValue('messages', $messages);
			$this->session->Set('messages', array());
		}
	}

	function setPageTitle($title) {
		$this->document->addValue('pagetitle', $title);
	}

	function render() {
		// render messages
		$this->writeMessages();
		$this->document->addValue('ORIGINAL_URL', ORIGINAL_URL);
		$this->document->addValue('ENCODED_URL', ENCODED_URL);
		$this->document->addValue('IMAGES_URL', IMAGES_URL);
		$this->document->addValue('PROJECT_URL', PROJECT_URL);
		
		// render formerrors
		$this->document->addValue('hilightFormElements', $this->request->getErrors());
		// кол-во отзывов
		$this->document->addValue('countNewItems', $this->countNewItems);
	}

	function getSessionID() {
		return PROJECT_SESSION_NAME . 'admin';
	}

}