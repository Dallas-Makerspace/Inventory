<?php
class ItemAttributesController extends AppController {

	var $name = 'ItemAttributes';

	function add() {
		if (!empty($this->data)) {
			if(!$this->ItemAttribute->Item->read(null,$this->data['ItemAttribute']['item_id'])) {
				$this->Session->setFlash(__('Invalid item specified', true));
				$this->redirect(array('controller' => 'categories', 'action' => 'index'));
			}
			$this->ItemAttribute->create();
			if ($this->ItemAttribute->save($this->data)) {
				$this->Session->setFlash(__('The attribute has been saved', true),'default',array('class' => 'success-message'));
				$this->redirect(array('controller' => 'items', 'action' => 'view', $this->data['ItemAttribute']['item_id']));
			} else {
				$this->Session->setFlash(__('The attribute could not be saved. Please, try again.', true));
			}
		}
		
		if(!isset($this->passedArgs['item'])) {
			$this->Session->setFlash(__('No item specified', true));
			$this->redirect(array('controller' => 'categories', 'action' => 'index'));
		}
		
		$this->data['ItemAttribute']['item_id'] = $this->passedArgs['item'];
		
		$attributes = $this->ItemAttribute->Attribute->find('list');
		
		$this->set(compact('attributes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid item attribute', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ItemAttribute->save($this->data)) {
				$this->Session->setFlash(__('The item attribute has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item attribute could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ItemAttribute->read(null, $id);
		}
		$item = $this->ItemAttribute->Item->read(null, $this->data['ItemAttribute']['item_id']);
		$attribute = $this->ItemAttribute->Attribute->read(null, $this->data['ItemAttribute']['attribute_id']);
		$this->set(compact('item', 'attribute'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for item attribute', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ItemAttribute->delete($id)) {
			$this->Session->setFlash(__('Item attribute deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Item attribute was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
