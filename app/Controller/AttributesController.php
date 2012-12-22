<?php
App::uses('AppController', 'Controller');
/**
 * Attributes Controller
 *
 * @property Attribute $Attribute
 */
class AttributesController extends AppController {
// TODO: This entire controller is a WIP
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Attribute->recursive = 1;
		$attributes = $this->Attribute->find('all');
		$this->set(compact('attributes'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Attribute->id = $id;
		if (!$this->Attribute->exists()) {
			throw new NotFoundException(__('Invalid attribute'));
		}
		$this->set('attribute', $this->Attribute->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Attribute->create();
			if ($this->Attribute->save($this->request->data)) {
				$this->Session->setFlash(__('The attribute has been saved'));
				$this->redirect(array('admin' => false, 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attribute could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Attribute->id = $id;
		if (!$this->Attribute->exists()) {
			throw new NotFoundException(__('Invalid attribute'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Attribute->save($this->request->data)) {
				$this->Session->setFlash(__('The attribute has been saved'));
				$this->redirect(array('admin' => false, 'action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The attribute could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Attribute->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Attribute->id = $id;
		if (!$this->Attribute->exists()) {
			throw new NotFoundException(__('Invalid attribute'));
		}
		if ($this->Attribute->delete()) {
			$this->Session->setFlash(__('Attribute deleted'));
			$this->redirect(array('admin' => false, 'action' => 'index'));
		}
		$this->Session->setFlash(__('Attribute was not deleted'));
		$this->redirect(array('admin' => false, 'action' => 'index'));
	}
}
