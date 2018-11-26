<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link	  http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since	 CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $helpers = array('Form', 'Html', 'Session', 'Js', 'Time', 'Tree');
	public $components = array(
		'Session',
		'RequestHandler',
		'Security' => array(
			'csrfUseOnce' => false,
		),
		'Auth' => array(
			'loginRedirect' => array('controller' => 'categories', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
			'authError' => 'Access denied',
			'authorize' => array('Controller'),
		),
	);

	// This function trims excesses whitespace from fields
	function whitespace(&$value, &$key) {
		$key = trim($key);
		$value = trim($value);
	}

	function beforeFilter(){
		// This calls whitespace() for all input data
		if(!empty($this->data)) array_walk_recursive($this->request->data, array($this, 'whitespace'));
	}

	public function isAuthorized($user) {
		$user = $this->Auth->user();
		$this->set(compact('user'));

		// All users can access every action
		if ($user && empty($this->request->params['admin'])) {
			return true;
		}

		// Only admins can access admin functions
		if (isset($this->request->params['admin']) && in_array('admins',$user['User']['groups'])) {
		    return true;
		}

		// Default, no access to actions
		return false;
	}

	function beforeRender() {
		// This allows us to require "at least one category" when adding/editing Item
		$model = Inflector::singularize($this->name);
		foreach($this->{$model}->hasAndBelongsToMany as $k=>$v) {
			if(isset($this->{$model}->validationErrors[$k])) {
				$this->{$model}->{$k}->validationErrors[$k] = $this->{$model}->validationErrors[$k];
			}
		}
	}
}
