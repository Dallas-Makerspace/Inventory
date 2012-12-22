<?php
App::uses('AppModel', 'Model');
/**
 * Item Model
 *
 * @property Room $Room
 * @property Comment $Comment
 * @property ItemAttribute $ItemAttribute
 * @property Attachment $Attachment
 * @property Verification $Verification
 * @property Category $Category
 */
class Item extends AppModel {

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
	public $actsAs = array('AuditLog.Auditable','HabtmCounterCache.HabtmCounterCache');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field is required.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'location' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field is required.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'owner' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field is required.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		// TODO: How should we handle qty for things like "4.2 liters of ______", by container?
		'qty' => array(
			'naturalNumber' => array(
				'rule' => array('naturalNumber'),
				'message' => 'Quantity must be a natural number.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'Category' => array(
			'multiple' => array(
				'rule' => array('multiple', array('min' => 1)),
				'message' => 'You must select at least one category.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Room' => array(
			'className' => 'Room',
			'foreignKey' => 'room_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'item_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => 'Comment.created DESC',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ItemAttribute' => array(
			'className' => 'ItemAttribute',
			'foreignKey' => 'item_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'item_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Verification' => array(
			'className' => 'Verification',
			'foreignKey' => 'item_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => 'Verification.created DESC',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Category' => array(
			'className' => 'Category',
			'joinTable' => 'items_categories',
			'foreignKey' => 'item_id',
			'associationForeignKey' => 'category_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => '',
			'counterCache' => true,
		)
	);

/**
 * beforeDelete callback
 * 
 */
	public function beforeDelete() {
		// If the directory doesn't exist, there's nothing that needs to be done
		if(!is_dir(APP.'Attachments'.DS.$this->id)) {
			return true;
		}

		// Using the File utility because I can
		App::uses('Folder', 'Utility');
		$folder = new Folder(APP.'Attachments'.DS.$this->id);

		// Delete the Attachments folder for this item
		if(!$folder->delete()) {
			// Unable to delete the folder, so we shouldn't delete the database record
			return false;
		}
		return true;
	}
}
