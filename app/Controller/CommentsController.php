<?php
App::uses('AppController', 'Controller');
/**
 * Comments Controller
 *
 * @property Comment $Comment
 */
class CommentsController extends AppController {

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			if(!$this->Comment->Item->read(null,$this->request->data['Comment']['item_id'])) {
				$this->Session->setFlash(__('Invalid item specified', true));
				$this->redirect(array('controller' => 'categories', 'action' => 'index'));
			}
			$this->Comment->create();
			$user = $this->Auth->user();
			$this->request->data['Comment']['username'] = $user['User']['username'];
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(__('The comment has been saved', true),'default',array('class' => 'success-message'));
				$this->redirect(array('controller' => 'items', 'action' => 'view', $this->request->data['Comment']['item_id']));
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.', true));
			}
		}
		
		if(!isset($this->passedArgs['item'])) {
			$this->Session->setFlash(__('No item specified', true));
			$this->redirect(array('controller' => 'categories', 'action' => 'index'));
		}
		
		$this->request->data['Comment']['item_id'] = $this->passedArgs['item'];
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
		$this->Comment->id = $id;
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Invalid comment'));
		}
		$comment = $this->Comment->read();
		if ($this->Comment->delete()) {
			$this->Session->setFlash(__('Comment deleted'));
			$this->redirect(array('controller' => 'items', 'action' => 'view', $comment['Item']['id'], 'admin' => false));
		}
		$this->Session->setFlash(__('Comment was not deleted'));
		$this->redirect(array('controller' => 'items', 'action' => 'view', $comment['Item']['id'], 'admin' => false));
	}
}
