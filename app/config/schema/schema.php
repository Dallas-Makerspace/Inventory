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
		'id' => array('type' => 'string', 'null' => false, 'key' => 'primary'),
		'data' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'expires' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $categories = array(
		'id' => array('type' => 'integer', 'null' => false, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => false),
		'name' => array('type' => 'string', 'null' => false),
		'lft' => array('type' => 'integer', 'null' => false),
		'rght' => array('type' => 'integer', 'null' => false),
		'item_count' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 5),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $comments = array(
		'id' => array('type' => 'integer', 'null' => false, 'key' => 'primary'),
		'item_id' => array('type' => 'integer', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => false),
		'username' => array('type' => 'string', 'null' => false),
		'message' => array('type' => 'text', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $items = array(
		'id' => array('type' => 'integer', 'null' => false, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => false),
		'modified' => array('type' => 'datetime', 'null' => false),
		'name' => array('type' => 'string', 'null' => false),
		'function' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'manufacturer' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'room_id' => array('type' => 'integer', 'null' => false),
		'location' => array('type' => 'string', 'null' => false),
		'owner' => array('type' => 'string', 'null' => false),
		'qty' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 5),
		'notes' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $items_categories = array(
		'id' => array('type' => 'integer', 'null' => false, 'key' => 'primary'),
		'item_id' => array('type' => 'integer', 'null' => false),
		'category_id' => array('type' => 'integer', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $logs = array(
		'id' => array('type' => 'integer', 'null' => false, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => false),
		'model' => array('type' => 'string', 'null' => false),
		'model_id' => array('type' => 'integer', 'null' => false),
		'action' => array('type' => 'string', 'null' => false),
		'description' => array('type' => 'string', 'null' => false),
		'username' => array('type' => 'string', 'null' => false),
		'change' => array('type' => 'string', 'null' => false),
		'version_id' => array('type' => 'integer', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $rooms = array(
		'id' => array('type' => 'integer', 'null' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $uploads = array(
		'id' => array('type' => 'integer', 'null' => false, 'key' => 'primary'),
		'item_id' => array('type' => 'integer', 'null' => false),
		'name' => array('type' => 'string', 'null' => false, 'key' => 'unique'),
		'description' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'type' => array('type' => 'string', 'null' => false),
		'size' => array('type' => 'integer', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => false),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'name' => array('column' => 'name', 'unique' => 1))
	);
	var $verifications = array(
		'id' => array('type' => 'integer', 'null' => false, 'key' => 'primary'),
		'item_id' => array('type' => 'integer', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => false),
		'username' => array('type' => 'string', 'null' => false),
		'comment' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
}
?>
