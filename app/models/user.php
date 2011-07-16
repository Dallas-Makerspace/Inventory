<?php 
class User extends AppModel {
	var $name = 'User';
	var $useDbConfig = 'ldap';
	var $primaryKey = 'uid';
	var $useTable = 'ou=People';
}
?>
