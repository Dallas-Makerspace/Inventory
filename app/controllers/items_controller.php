<?php
class ItemsController extends AppController {

	var $name = 'Items';

	function index() {
		$this->Item->recursive = 0;
		$this->set('items', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid item', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('item', $this->Item->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Item->create();
			if ($this->Item->save($this->data)) {
				$this->Session->setFlash(__('The item has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.', true));
			}
		}
		$rooms = $this->Item->Room->find('list');
				
		$category_tree = $this->Item->Category->generatetreelist(null,null,null," - ");
		if ($category_tree) {
			foreach ($category_tree as $key=>$value) {
				$categories[$key] = $value;
			}
		}
		
		$this->set(compact('rooms', 'categories'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid item', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Item->save($this->data)) {
				$this->Session->setFlash(__('The item has been saved', true));
				$this->redirect(array('action' => 'view', $this->data['Item']['id']));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Item->read(null, $id);
		}
		$rooms = $this->Item->Room->find('list');

		$category_tree = $this->Item->Category->generatetreelist(null,null,null," - ");
		if ($category_tree) {
			foreach ($category_tree as $key=>$value) {
				$categories[$key] = $value;
			}
		}

		$this->set(compact('rooms', 'categories'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for item', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Item->delete($id)) {
			$this->Session->setFlash(__('Item deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Item was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function search() {
		if($this->data) {
			// We are redirecting the POST request to a pretty looking URL
			$this->redirect(array('all' => $this->data['Item']['search']));
		}

		if(isset($this->passedArgs['all'])) {
			$search = $this->passedArgs['all'];
		} else {
			$search = null;
		}
		
		if(isset($this->passedArgs['function'])) {
			$search = array('Item.function LIKE' => "%{$this->passedArgs['function']}%");
		} elseif(isset($this->passedArgs['manufacturer'])) {
			$search = array('Item.manufacturer LIKE' => "%{$this->passedArgs['manufacturer']}%");
		} elseif(isset($this->passedArgs['name'])) {
			$search = array('Item.name LIKE' => "%{$this->passedArgs['name']}%");
		} elseif(isset($this->passedArgs['location'])) {
			$search = array('Item.location LIKE' => "%{$this->passedArgs['location']}%");
		} elseif($search) {
			$search = array('OR' => array(
				'Item.function LIKE' => "%{$search}%",
				'Item.manufacturer LIKE' => "%{$search}%",
				'Item.name LIKE' => "%{$search}%",
				'Item.location LIKE' => "%{$search}%",
			));
		}
		
		if($search) {
			$this->Item->recursive = 0;
			$this->set('items', $this->paginate('Item', $search));
		}
	}
}
