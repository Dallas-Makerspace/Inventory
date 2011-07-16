<?php
class AppController extends Controller {

	var $components = array('RequestHandler', 'LdapAuth', 'Session');
	var $helpers = array('Time', 'Html', 'Session', 'Js', 'Paginator', 'Text', 'Tree');

	// This function trims excesses whitespace from fields
	function whitespace(&$value, &$key){
		$key = trim($key);
		$value = trim($value);
	}

	// This calls whitespace() for all input data
	function beforeFilter(){
		if(!empty($this->data)) array_walk_recursive($this->data, array($this, 'whitespace'));
		$this->set('uid',$this->LdapAuth->user('uid'));
	}

}
?>
