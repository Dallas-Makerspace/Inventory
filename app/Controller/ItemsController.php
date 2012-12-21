<?php
App::uses('AppController', 'Controller');
/**
 * Items Controller
 *
 * @property Item $Item
 */
class ItemsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Item->recursive = 0;
		$this->set('items', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		$this->set('item', $this->Item->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Item->create();
			if ($this->Item->save($this->request->data)) {
				$this->Session->setFlash(__('The item has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.'));
			}
		}
		$rooms = $this->Item->Room->find('list');
		$categories = $this->Item->Category->find('list');
		$this->set(compact('rooms', 'categories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Item->save($this->request->data)) {
				$this->Session->setFlash(__('The item has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Item->read(null, $id);
		}
		$rooms = $this->Item->Room->find('list');
		$categories = $this->Item->Category->find('list');
		$this->set(compact('rooms', 'categories'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		if ($this->Item->delete()) {
			$this->Session->setFlash(__('Item deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Item was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * view method
 *
 * @return void
 */
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
