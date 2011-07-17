<?php
class UploadsController extends AppController {

	var $name = 'Uploads';

/*
	TODO: Have files served through CakePHP for security
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid upload', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('upload', $this->Upload->read(null, $id));
	}
*/

	function add() {
		if (!empty($this->data)) {
			if(!$this->Upload->Item->read(null,$this->data['Upload']['item_id'])) {
				$this->Session->setFlash(__('Invalid item specified', true));
				$this->redirect(array('controller' => 'categories', 'action' => 'index'));
			}
			$this->Upload->create();
			$this->data['Upload']['name'] = $this->data['Upload']['file']['name'];
			$this->data['Upload']['type'] = $this->data['Upload']['file']['type'];
			$this->data['Upload']['size'] = $this->data['Upload']['file']['size'];
			if ($this->Upload->save($this->data)) {
				if(rename($this->data['Upload']['file']['tmp_name'],'files/'.$this->data['Upload']['name'])) {
					$this->Session->setFlash(__('The file has been saved', true));
					$this->redirect(array('controller' => 'items', 'action' => 'view', $this->data['Upload']['item_id']));
				} else {
					$this->Session->setFlash(__('The file has been added to the database but may not have been saved to disk.', true));
					$this->redirect(array('controller' => 'items', 'action' => 'view', $this->data['Upload']['item_id']));
				}
			} else {
				$this->Session->setFlash(__('The file could not be saved. Please, try again.', true));
			}
		}
		
		if(!isset($this->passedArgs['item'])) {
			//$this->Session->setFlash(__('No item specified', true));
			//$this->redirect(array('controller' => 'categories', 'action' => 'index'));
		}
		
		$this->data['Upload']['item_id'] = $this->passedArgs['item'];
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for upload', true));
			$this->redirect($this->referer());
		}
		if ($this->Upload->delete($id)) {
			$this->Session->setFlash(__('Upload deleted', true));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Upload was not deleted', true));
		$this->redirect($this->referer());
	}
}
