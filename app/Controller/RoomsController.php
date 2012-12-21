<?php
App::uses('AppController', 'Controller');
/**
 * Rooms Controller
 *
 * @property Room $Room
 */
class RoomsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Room->recursive = 1;
		$rooms = $this->Room->find('all');
		$this->set(compact('rooms'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Room->id = $id;
		if (!$this->Room->exists()) {
			throw new NotFoundException(__('Invalid room'));
		}
		$this->set('room', $this->Room->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Room->create();
			if ($this->Room->save($this->request->data)) {
				$this->Session->setFlash(__('The room has been saved'));
				$this->redirect(array('admin' => false, 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The room could not be saved. Please, try again.'));
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
		$this->Room->id = $id;
		if (!$this->Room->exists()) {
			throw new NotFoundException(__('Invalid room'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Room->save($this->request->data)) {
				$this->Session->setFlash(__('The room has been saved'));
				$this->redirect(array('admin' => false, 'action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The room could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Room->read(null, $id);
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
		$this->Room->id = $id;
		if (!$this->Room->exists()) {
			throw new NotFoundException(__('Invalid room'));
		}
		if ($this->Room->delete()) {
			$this->Session->setFlash(__('Room deleted'));
			$this->redirect(array('admin' => false, 'action' => 'index'));
		}
		$this->Session->setFlash(__('Room was not deleted'));
		$this->redirect(array('admin' => false, 'action' => 'index'));
	}
}
