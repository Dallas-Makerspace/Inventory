<?php
class CommentsController extends AppController {

	var $name = 'Comments';

	function add() {
		if (!empty($this->data)) {
			if(!$this->Comment->Item->read(null,$this->data['Comment']['item_id'])) {
				$this->Session->setFlash(__('Invalid item specified', true));
				$this->redirect(array('controller' => 'categories', 'action' => 'index'));
			}
			$this->Comment->create();
			$this->data['Comment']['username'] = $this->LdapAuth->user('uid');
			if ($this->Comment->save($this->data)) {
				$this->Session->setFlash(__('The comment has been saved', true));
				$this->redirect(array('controller' => 'items', 'action' => 'view', $this->data['Comment']['item_id']));
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.', true));
			}
		}
		
		if(!isset($this->passedArgs['item'])) {
			$this->Session->setFlash(__('No item specified', true));
			$this->redirect(array('controller' => 'categories', 'action' => 'index'));
		}
		
		$this->data['Comment']['item_id'] = $this->passedArgs['item'];
	}
}
