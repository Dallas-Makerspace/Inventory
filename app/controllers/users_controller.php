<?php
class UsersController extends AppController {

	var $name = 'Users';    

	function login() {
	}

	function logout() {
		$this->redirect($this->LdapAuth->logout());
	}

	function isAuthorized() {
		return true;
	}

}
?>
