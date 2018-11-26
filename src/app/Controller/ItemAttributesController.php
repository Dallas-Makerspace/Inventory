<?php
App::uses('AppController', 'Controller');
/**
 * ItemAttributes Controller
 *
 * @property ItemAttribute $ItemAttribute
 */
class ItemAttributesController extends AppController {

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			if(!$this->ItemAttribute->Item->read(null,$this->request->data['ItemAttribute']['item_id'])) {
				$this->Session->setFlash(__('Invalid item specified', true));
				$this->redirect(array('controller' => 'categories', 'action' => 'index'));
			}
			$this->ItemAttribute->create();
			if ($this->ItemAttribute->save($this->request->data)) {
				$this->Session->setFlash(__('The attribute has been saved', true),'default',array('class' => 'success-message'));
				$this->redirect(array('controller' => 'items', 'action' => 'view', $this->request->data['ItemAttribute']['item_id']));
			} else {
				$this->Session->setFlash(__('The attribute could not be saved. Please, try again.', true));
			}
		}
		
		if(!isset($this->passedArgs['item'])) {
			$this->Session->setFlash(__('No item specified', true));
			$this->redirect(array('controller' => 'categories', 'action' => 'index'));
		}
		
		$this->request->data['ItemAttribute']['item_id'] = $this->passedArgs['item'];
		
		$attributes = $this->ItemAttribute->Attribute->find('list');
		
		$this->set(compact('attributes'));
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
				$this->redirect(array('controller' => 'items', 'action' => 'view', $this->request->data['ItemAttribute']['item_id']));
			} else {
				$this->Session->setFlash(__('The item attribute could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ItemAttribute->read(null, $id);
		}

		$item = $this->ItemAttribute->Item->read(null, $this->request->data['ItemAttribute']['item_id']);
		$attribute = $this->ItemAttribute->Attribute->read(null, $this->request->data['ItemAttribute']['attribute_id']);
		$this->set(compact('item', 'attribute'));
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
		$item_attribute = $this->ItemAttribute->read();
		if ($this->ItemAttribute->delete()) {
			$this->Session->setFlash(__('Item attribute deleted'));
			$this->redirect(array('controller' => 'items', 'action' => 'view', $item_attribute['Item']['id']));
		}
		$this->Session->setFlash(__('Item attribute was not deleted'));
		$this->redirect(array('controller' => 'items', 'action' => 'view', $item_attribute['Item']['id']));
	}
}
