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

		$item = $this->Item->read(null, $id);
		$attributes = $this->Item->ItemAttribute->findAllByItemId($id);
		$this->set(compact('item','attributes'));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Item->create();
			if ($this->Item->save($this->data)) {
				$this->Session->setFlash(__('The item has been saved', true),'default',array('class' => 'success-message'));
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
				$this->Session->setFlash(__('The item has been saved', true),'default',array('class' => 'success-message'));
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
			$this->redirect(array('all' => str_replace(' ','+',$this->data['Item']['search'])));
		}

		if(isset($this->passedArgs['all'])) {
			$search_terms = $this->passedArgs['all'];
		} else {
			$search_terms = null;
		}

		$search = false;

		if(isset($this->passedArgs['name'])) {
			foreach(explode(' ',$this->passedArgs['name']) as $string) {
				$search['OR'][] = array('Item.name LIKE' => "%{$string}%");
			}
		} elseif(isset($this->passedArgs['location'])) {
			foreach(explode(' ',$this->passedArgs['location']) as $string) {
				$search['OR'][] = array('Item.location LIKE' => "%{$string}%");
			}
		} elseif(isset($this->passedArgs['owner'])) {
			foreach(explode(' ',$this->passedArgs['owner']) as $string) {
				$search['OR'][] = array('Item.owner LIKE' => "%{$string}%");
			}
		} elseif($search_terms) {
			$search = array('OR' => array());
			foreach(explode(' ',$search_terms) as $string) {
				$search['OR'][] = array('Item.name LIKE' => "%{$string}%");
				$search['OR'][] = array('Item.location LIKE' => "%{$string}%");
				$search['OR'][] = array('Item.owner LIKE' => "%{$string}%");
			}
		}
		
		if($search) {
			$this->Item->recursive = 0;
			$items = $this->paginate('Item', $search);
			if(count($items) == 1) {
				$this->redirect(array('action'=>'view',$items[0]['Item']['id']));
			}
		}

		$this->set(compact('search_terms','items'));
	}
}
