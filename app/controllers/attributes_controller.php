<?php
class AttributesController extends AppController {

	var $name = 'Attributes';

	function index() {
		$this->Attribute->recursive = 0;
		$this->set('attributes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid attribute', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('attribute', $this->Attribute->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Attribute->create();
			if ($this->Attribute->save($this->data)) {
				$this->Session->setFlash(__('The attribute has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attribute could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid attribute', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Attribute->save($this->data)) {
				$this->Session->setFlash(__('The attribute has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attribute could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Attribute->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for attribute', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Attribute->delete($id)) {
			$this->Session->setFlash(__('Attribute deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Attribute was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
