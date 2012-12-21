<?php
App::uses('AppController', 'Controller');
/**
 * Verifications Controller
 *
 * @property Verification $Verification
 */
class VerificationsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Verification->recursive = 0;
		$this->set('verifications', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Verification->id = $id;
		if (!$this->Verification->exists()) {
			throw new NotFoundException(__('Invalid verification'));
		}
		$this->set('verification', $this->Verification->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Verification->create();
			if ($this->Verification->save($this->request->data)) {
				$this->Session->setFlash(__('The verification has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The verification could not be saved. Please, try again.'));
			}
		}
		$items = $this->Verification->Item->find('list');
		$this->set(compact('items'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Verification->id = $id;
		if (!$this->Verification->exists()) {
			throw new NotFoundException(__('Invalid verification'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Verification->save($this->request->data)) {
				$this->Session->setFlash(__('The verification has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The verification could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Verification->read(null, $id);
		}
		$items = $this->Verification->Item->find('list');
		$this->set(compact('items'));
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
		$this->Verification->id = $id;
		if (!$this->Verification->exists()) {
			throw new NotFoundException(__('Invalid verification'));
		}
		if ($this->Verification->delete()) {
			$this->Session->setFlash(__('Verification deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Verification was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
