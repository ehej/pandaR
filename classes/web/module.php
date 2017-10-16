<?php

include_once(realpath(dirname(__FILE__)."/../variables.php"));

Kernel::Import("system.page.Page");
Kernel::Import('system.response.SmartyResponse');
Kernel::Import('classes.logger.*');


class Module extends Page {
	public $mod_folder;
	function __construct($Template) {
		parent::__construct($Template='');
		$this->setResponse(new SmartyResponse($this, $this->document));
	}

	function addErrorMessage($message) {
		$this->addMessage($message, true);
	}

	function getSessionID() {
		return PROJECT_SESSION_NAME . 'user';
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

	function render() {
		// render messages
		$this->writeMessages();
		$this->document->addValue('ORIGINAL_URL', ORIGINAL_URL);
		$this->document->addValue('ENCODED_URL', ENCODED_URL);
		$this->document->addValue('IMAGES_URL', IMAGES_URL);
		$this->document->addValue('PROJECT_URL', PROJECT_URL);
	}

	function getTemplatesRoot() {
		return "module/".($this->mod_folder?$this->mod_folder.'/':'');
	}
}