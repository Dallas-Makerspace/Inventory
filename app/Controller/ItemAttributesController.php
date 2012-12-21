<?php
App::uses('AppController', 'Controller');
/**
 * ItemAttributes Controller
 *
 * @property ItemAttribute $ItemAttribute
 */
class ItemAttributesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ItemAttribute->recursive = 0;
		$this->set('itemAttributes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ItemAttribute->id = $id;
		if (!$this->ItemAttribute->exists()) {
			throw new NotFoundException(__('Invalid item attribute'));
		}
		$this->set('itemAttribute', $this->ItemAttribute->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ItemAttribute->create();
			if ($this->ItemAttribute->save($this->request->data)) {
				$this->Session->setFlash(__('The item attribute has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item attribute could not be saved. Please, try again.'));
			}
		}
		$items = $this->ItemAttribute->Item->find('list');
		$attributes = $this->ItemAttribute->Attribute->find('list');
		$this->set(compact('items', 'attributes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->ItemAttribute->id = $id;
		if (!$this->ItemAttribute->exists()) {
			throw new NotFoundException(__('Invalid item attribute'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ItemAttribute->save($this->request->data)) {
				$this->Session->setFlash(__('The item attribute has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item attribute could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ItemAttribute->read(null, $id);
		}
		$items = $this->ItemAttribute->Item->find('list');
		$attributes = $this->ItemAttribute->Attribute->find('list');
		$this->set(compact('items', 'attributes'));
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
		$this->ItemAttribute->id = $id;
		if (!$this->ItemAttribute->exists()) {
			throw new NotFoundException(__('Invalid item attribute'));
		}
		if ($this->ItemAttribute->delete()) {
			$this->Session->setFlash(__('Item attribute deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Item attribute was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
