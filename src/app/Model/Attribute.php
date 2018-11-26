<?php
App::uses('AppModel', 'Model');
/**
 * Attribute Model
 *
 * @property Item $Item
 */
class Attribute extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Behaviours
 *
 * @var array
 */
	public $actsAs = array('AuditLog.Auditable');

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ItemAttribute' => array(
			'className' => 'ItemAttribute',
			'foreignKey' => 'item_id',
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
