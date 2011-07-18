<?php
App::import('sanitize');
class AppController extends Controller {

	var $components = array('RequestHandler', 'LdapAuth', 'Session', 'Security');
	var $helpers = array('Time', 'Html', 'Session', 'Js', 'Paginator', 'Text', 'Tree', 'Number', 'Qrcode');

	// This function trims excesses whitespace from fields
	function whitespace(&$value, &$key){
		$key = trim($key);
		$value = trim($value);
	}

	// This calls whitespace() for all input data
	function beforeFilter(){
		if(!empty($this->data)) array_walk_recursive($this->data, array($this, 'whitespace'));
		$this->set('uid',$this->LdapAuth->user('uid'));

		if (sizeof($this->uses) && $this->{$this->modelClass}->Behaviors->attached('Logable')) {
			$this->{$this->modelClass}->setUserData($this->LdapAuth->user('uid'));
		}
	}

}
?>
