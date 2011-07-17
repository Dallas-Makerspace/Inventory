<?php
class VerificationsController extends AppController {

	var $name = 'Verifications';

	function add() {
		if (!empty($this->data)) {
			if(!$this->Verification->Item->read(null,$this->data['Verification']['item_id'])) {
				$this->Session->setFlash(__('Invalid item specified', true));
				$this->redirect(array('controller' => 'categories', 'action' => 'index'));
			}
			$this->Verification->create();
			$this->data['Verification']['username'] = $this->LdapAuth->user('uid');
			if ($this->Verification->save($this->data)) {
				$this->Session->setFlash(__('The verification has been saved', true));
				$this->redirect(array('controller' => 'items', 'action' => 'view', $this->data['Verification']['item_id']));
			} else {
				$this->Session->setFlash(__('The verification could not be saved. Please, try again.', true));
			}
		}
		
		if(!isset($this->passedArgs['item'])) {
			$this->Session->setFlash(__('No item specified', true));
			$this->redirect(array('controller' => 'categories', 'action' => 'index'));
		}
		
		$this->data['Verification']['item_id'] = $this->passedArgs['item'];
	}
}
