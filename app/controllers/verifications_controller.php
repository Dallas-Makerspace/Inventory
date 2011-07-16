<?php
class VerificationsController extends AppController {

	var $name = 'Verifications';

	function index() {
		$this->Verification->recursive = 0;
		$this->set('verifications', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid verification', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('verification', $this->Verification->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Verification->create();
			if ($this->Verification->save($this->data)) {
				$this->Session->setFlash(__('The verification has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The verification could not be saved. Please, try again.', true));
			}
		}
		$items = $this->Verification->Item->find('list');
		$this->set(compact('items'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid verification', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Verification->save($this->data)) {
				$this->Session->setFlash(__('The verification has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The verification could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Verification->read(null, $id);
		}
		$items = $this->Verification->Item->find('list');
		$this->set(compact('items'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for verification', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Verification->delete($id)) {
			$this->Session->setFlash(__('Verification deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Verification was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
