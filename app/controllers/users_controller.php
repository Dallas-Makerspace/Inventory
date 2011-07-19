<?php
class UsersController extends AppController {

	var $name = 'Users';    

	function login() {
		if ($this->LdapAuth->user()) {
			$this->redirect(array('controller' => 'categories'));
		}
	}

	function logout() {
		$this->redirect($this->LdapAuth->logout());
	}

	function isAuthorized() {
		return true;
	}

}
?>
