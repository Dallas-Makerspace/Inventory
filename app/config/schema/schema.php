<?php
/* App schema generated on: 2011-07-18 12:02:01 : 1311008521*/
class AppSchema extends CakeSchema {
	var $name = 'App';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $cake_sessions = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'data' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'expires' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('engine' => 'MyISAM')
	);
	var $categories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'lft' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'rght' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'item_count' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 5),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('engine' => 'MyISAM')
	);
	var $comments = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'username' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'message' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('engine' => 'MyISAM')
	);
	var $items = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'function' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'manufacturer' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'room_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'location' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'owner' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'qty' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5),
		'notes' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('engine' => 'MyISAM')
	);
	var $items_categories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'category_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('engine' => 'MyISAM')
	);
	var $rooms = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('engine' => 'MyISAM')
	);
	var $uploads = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'unique'),
		'description' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'type' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'size' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'name' => array('column' => 'name', 'unique' => 1)),
		'tableParameters' => array('engine' => 'MyISAM')
	);
	var $verifications = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'username' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'comment' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('engine' => 'MyISAM')
	);
}
?>
