<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 */
class CategoriesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		// Generate a listing of all top level categories
		$this->Category->recursive = 0;
		$categories = $this->Category->findAllByParentId(0);
		
		foreach($categories as &$category) {
			$category['Category']['category_count'] = $this->Category->childCount($category['Category']['id']);
			$children = $this->Category->children($category['Category']['id']);
			foreach($children as $child) {
				$category['Category']['item_count'] += $child['Category']['item_count'];
			}
		}
		$this->set(compact('categories'));
	}

/**
 * all method
 *
 * @return void
 */
	public function all() {
		// Generate a listing of all categories
		//$categories = $this->Category->generatetreelist();
		$this->Category->recursive = 0;
		$categories = $this->Category->find('threaded');
		$this->set(compact('categories'));
}

/**
 * getAllCategories method
 *
 * Used to display a list of categorys in the "categorys" element.
 *
 * @return void
 */
	public function getAllCategories() {
		if (!isset($this->params['requested'])) {
			$this->cakeError('error404');
		}
		
		return $this->Category->generateTreeList(null,null,null,' - ');
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}

		// We need to set recursive to 2 so that we can see the name of the room each item is in
		$this->Category->recursive = 2;

		//Unbinding models that aren't needed to reduce the database usage
		$this->Category->Item->unbindModel(
			array('hasMany' => array('Comment','Verification'))
		);

		// Read data for this category, including items that are in it
		$category = $this->Category->read();
		
		//TODO: paginate the items
		//list($category) = $this->paginate('Category',array('Category.id' => $this->id));
		
		if (!$category) {
			// The category doesn't exist
			$this->Session->setFlash(__('Invalid category', true));
			$this->redirect(array('action' => 'index'));
		}

		// Get the "path" for this category (e.g. /Electronics/Components/Microcontrollers)
		$path = $this->Category->getPath();

		// Get all direct child categories
		$children = $this->Category->children($this->id,true);

		foreach($children as &$child) {
			$child['Category']['category_count'] = $this->Category->childCount($child['Category']['id']);
			$grandchildren = $this->Category->children($child['Category']['id']);
			foreach($grandchildren as $grandchild) {
				$child['Category']['item_count'] += $grandchild['Category']['item_count'];
			}
		}
		$this->set(compact('category','children','path'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been created'));
				$this->redirect(array('action' => 'view', $this->Category->id));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		}

		$parents[0] = "[Top]";
		$categories = $this->Category->generateTreeList(null,null,null," - ");
		if ($categories) {
			foreach ($categories as $key=>$value) {
				$parents[$key] = $value;
			}
		}
		$this->set(compact('parents'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved'));
				$this->redirect(array('action' => 'view', $this->Category->id));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Category->read(null, $id);
		}

		$parents[0] = "[Top]";
		$categories = $this->Category->generateTreeList(null,null,null," - ");
		if($categories) {
			foreach ($categories as $key=>$value) {
				$parents[$key] = $value;
			}
		}
		$this->set(compact('parents'));
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
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		if (!empty($this->request->data) && ($this->request->is('post') || $this->request->is('put'))) {
			//time to delete stuff
			$deleted = false;
			switch($this->data['Category']['option']) {
				//case 'all':
					//Delete category, all child categories and all associated items
					//if ($this->Category->delete($id,true)) {
					//	$deleted = true;
					//}
					//break;
				case 'children':
					//Delete category and all child categories, leaving all items
					if ($this->Category->delete($id)) {
						$deleted = true;
					}
					break;
				//case 'items':
					//Delete category and all associated items, leaving child categories and their items
					//TODO: Investigate if there is an easy way to do this
					//break;
				case 'only':
					//Delete just this category, leaving all items and child categories
					if ($this->Category->removeFromTree($id,true)) {
						$deleted = true;
					}
					break;
			}
			if($deleted) {
				$this->Session->setFlash(__('Category deleted', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Category was not deleted', true));
				$this->redirect(array('action' => 'index'));
			}
		} else {
			$this->Category->recursive = 0;
			$this->data = $this->Category->read(null, $id);
		}
		
		if (empty($this->request->data['Category'])) {
			$this->Session->setFlash(__('Invalid id for category', true));
			$this->redirect(array('action'=>'index'));
		}
	}
}
