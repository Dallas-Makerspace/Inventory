<?php
class CategoriesController extends AppController {

	var $name = 'Categories';

	function index() {
		// Generate a listing of all top level categories
		$categories = $this->Category->generatetreelist(array('parent_id'=>0));
		$this->set(compact('categories'));
	}

	function all() {
		// Generate a listing of all categories
		//$categories = $this->Category->generatetreelist();
		$this->Category->recursive = 0;
		$categories = $this->Category->find('threaded');
		$this->set(compact('categories'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid category', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->id = $id;

		// We need to set recursive to 2 so that we can see the name of the room each item is in
		$this->Category->recursive = 2;

		//Unbinding models that aren't needed to reduce the database usage
		$this->Category->Item->unbindModel(
			array('hasMany' => array('Comment','Verification'))
		);

		// Read data for this category, including items that are in it
		$category = $this->Category->read();
		if (!$category) {
			// The category doesn't exist
			$this->Session->setFlash(__('Invalid category', true));
			$this->redirect(array('action' => 'index'));
		}

		// Get the "path" for this category (e.g. /Electronics/Components/Microcontrollers)
		$path = $this->Category->getpath();

		// Get all direct child categories
		$children = $this->Category->children($this->id,true);

		$this->set(compact('category','children','path'));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Category->create();
			if ($this->Category->save($this->data)) {
				$this->Session->setFlash(__('The category has been added', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.', true));
			}
		}

		$parents[0] = "[Top]";
		$categories = $this->Category->generatetreelist(null,null,null," - ");
		if($categories) {
			foreach ($categories as $key=>$value) {
				$parents[$key] = $value;
			}
		}
		$items = $this->Category->Item->find('list');
		$this->set(compact('items','parents'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid category', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Category->save($this->data)) {
				$this->Session->setFlash(__('The category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Category->read(null, $id);
		}

		$parents[0] = "[Top]";
		$categories = $this->Category->generatetreelist(null,null,null," - ");
		if($categories) {
			foreach ($categories as $key=>$value) {
				$parents[$key] = $value;
			}
		}
		$items = $this->Category->Item->find('list');
		$this->set(compact('items','parents'));
	}

	function delete($id = null) {
/*
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for category', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Category->delete($id)) {
			$this->Session->setFlash(__('Category deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Category was not deleted', true));
		$this->redirect(array('action' => 'index'));
*/
	}
}
