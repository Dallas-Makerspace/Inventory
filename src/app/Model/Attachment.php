<?php
App::uses('AppModel', 'Model');
/**
 * Attachment Model
 *
 * @property Item $Item
 */
class Attachment extends AppModel {

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

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'file' => array(
			'unique' => array(
				'rule' => array('checkUnique', array('name', 'item_id')), 
				'message' => 'There is already a file with that name attached to the item.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			// This should keep users from tricking us into working on a non-uploaded file, say /etc/shadow
			'isUploadedFile' => array(
				'rule' => array('isUploadedFile'), 
				'message' => 'I feel a disturbance in the app.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'You did not specify a file to upload.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * beforeValidate callback
 * 
 */
	public function beforeValidate() {
		// Set the name, type and size fields from the file upload so they can be validated
		$this->data['Attachment']['name'] = $this->data['Attachment']['file']['name'];
		$this->data['Attachment']['type'] = $this->data['Attachment']['file']['type'];
		$this->data['Attachment']['size'] = $this->data['Attachment']['file']['size'];
		return true;
	}

/**
 * beforeSave callback
 * 
 */
	public function beforeSave() {
		// Using the Folder utility because I can
		App::uses('Folder', 'Utility');
		$folder = new Folder();

		// Create a folder for the item: app/Attachments/$item_id if it doesn't exist
		if (!$folder->create(APP . 'Attachments' . DS . $this->data['Attachment']['item_id'])) {
			// Failed to create the folder! I told them we didn't have enough space to mirror the entire Ubuntu repo...
			return false;
		}

		// Move uploaded file from tmp to app/Attachemnts/$item_id folder
		if(!move_uploaded_file($this->data['Attachment']['file']['tmp_name'],APP.'Attachments'.DS.$this->data['Attachment']['item_id'].DS.$this->data['Attachment']['name'])) {
			// Failed to move the file!
			return false;
		}
		return true;
	}

/**
 * beforeDelete callback
 * 
 */
	public function beforeDelete($cascade) {
		// $this->data is empty, so we're probably being called by Item->delete, so the folder and files are already gone
		if(empty($this->data)) {
			return true;
		}

		// The file is already gone...
		if(!file_exists(APP.'Attachments'.DS.$this->data['Attachment']['item_id'].DS.$this->data['Attachment']['name'])) {
			return true;
		}

		// Using the File utility because I can
		App::uses('File', 'Utility');
		$file = new File(APP.'Attachments'.DS.$this->data['Attachment']['item_id'].DS.$this->data['Attachment']['name']);

		// Delete the file
		if(!$file->delete()) {
			// Unable to delete the file, so we shouldn't delete the database record
			return false;
		}
		return true;
	}
}
