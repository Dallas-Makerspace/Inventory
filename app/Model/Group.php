<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 */
class Group extends AppModel {
	public $useDbConfig = 'ldap';
	public $useTable = 'ou=groups';

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'uid',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
}
