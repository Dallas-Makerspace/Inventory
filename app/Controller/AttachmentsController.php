<?php
App::uses('AppController', 'Controller');
/**
 * Attachments Controller
 *
 * @property Attachment $Attachment
 */
class AttachmentsController extends AppController {

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Attachment->id = $id;
		if (!$this->Attachment->exists()) {
			throw new NotFoundException(__('Invalid attachment'));
		}

		$this->Attachment->recursive = -1;
		$attachment = $this->Attachment->read(null, $id);

		//$this->response->file(APP.'Attachments'.DS.$attachment['Attachment']['item_id'].DS.$attachment['Attachment']['name'], array('download' => true, 'name' => $attachment['Attachment']['name']));
		$this->response->file(APP.'Attachments'.DS.$attachment['Attachment']['item_id'].DS.$attachment['Attachment']['name']);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Attachment->create();
			if ($this->Attachment->save($this->request->data)) {
				$this->Session->setFlash(__('The attachment has been saved'));
				$this->redirect(array('controller' => 'items', 'action' => 'view', $this->request->data['Attachment']['item_id']));
			} else {
				$this->Session->setFlash(__('The attachment could not be saved. Please, try again.'));
			}
		}

		$this->request->data['Attachment']['item_id'] = $this->passedArgs['item'];
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
		$this->Attachment->id = $id;
		if (!$this->Attachment->exists()) {
			throw new NotFoundException(__('Invalid attachment'));
		}
		$attachment = $this->Attachment->read();
		if ($this->Attachment->delete()) {
			$this->Session->setFlash(__('Attachment deleted'));
			$this->redirect(array('controller' => 'items', 'action' => 'view', $attachment['Item']['id']));
		}
		$this->Session->setFlash(__('Attachment was not deleted'));
		$this->redirect(array('controller' => 'items', 'action' => 'view', $attachment['Item']['id']));
	}
}
