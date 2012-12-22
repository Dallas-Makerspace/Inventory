<?php
App::uses('AppController', 'Controller');
/**
 * Verifications Controller
 *
 * @property Verification $Verification
 */
class VerificationsController extends AppController {

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$item = $this->Verification->Item->read(null,$this->passedArgs['item']);
		if ($this->request->is('post')) {
			if(!$item) {
				$this->Session->setFlash(__('Invalid item specified', true));
				$this->redirect(array('controller' => 'categories', 'action' => 'index'));
			}
			$this->Verification->create();
			$user = $this->Auth->user();
			$this->request->data['Verification']['username'] = $user['User']['username'];
			if ($this->Verification->save($this->request->data)) {
				$this->Session->setFlash(__('The verification has been saved', true),'default',array('class' => 'success-message'));
				$this->redirect(array('controller' => 'items', 'action' => 'view', $this->request->data['Verification']['item_id']));
			} else {
				$this->Session->setFlash(__('The verification could not be saved. Please, try again.', true));
			}
		}
		
		if(!isset($this->passedArgs['item'])) {
			$this->Session->setFlash(__('No item specified', true));
			$this->redirect(array('controller' => 'categories', 'action' => 'index'));
		}
		
		$this->request->data['Verification']['item_id'] = $this->passedArgs['item'];

		$this->set(compact('item'));
	}

}
