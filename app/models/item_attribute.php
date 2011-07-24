<?php
class ItemAttribute extends AppModel {
	var $name = 'ItemAttribute';
	var $actsAs = array('Logable' => array('change' => 'full'));
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Item name is required.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);
	
	var $belongsTo = array('Item','Attribute');
	
}
