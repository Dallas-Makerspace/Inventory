<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 */
class User extends AppModel {
	public $useDbConfig = 'ldap';
	public $useTable = 'ou=people';

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'memberuid',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
