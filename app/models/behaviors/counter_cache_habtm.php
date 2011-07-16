<?php
/**
 * CounterCacheHabtmBehavior - add counter cache support for HABTM relations
 *
 * Based on CounterCacheBehavior by Derick Ng aka dericknwq
 *
 * @see http://bakery.cakephp.org/articles/view/counter-cache-behavior-for-habtm-relations
 * @author Yuri Pimenov aka Danaki (http://blog.gate.lv)
 * @version 2009-05-28
 */
class CounterCacheHabtmBehavior extends ModelBehavior {
	/**
	 * Array to store intermediate results
	 *
	 * @var array
	 * @access public
	 */
	var $foreignTableIDs = array();

	/**
	 * For each HABTM association using given id, find related foreign ids
	 * that represent in the join table. Save results to $foreignTableIDs array.
	 *
	 * @param mixed $model
	 * @access private
	 * @return void
	 */
	function findForeignIDs(&$model) {
		foreach ($model->hasAndBelongsToMany as $assocKey => $assocData) {
			$assocModel =& $model->{$assocData['className']};
			$field = Inflector::underscore($model->name).'_count';

			if ($assocModel->hasField($field)) {
				$joinModel =& $model->{$assocData['with']};

				$joinIDs = $joinModel->find('all', array(
					'fields' => array($assocData['associationForeignKey']),
					'conditions' => array($assocData['foreignKey'] => $model->id),
					'group' => $assocData['associationForeignKey']
				));

				$this->foreignTableIDs[$assocData['className']] = array_keys(
					Set::combine($joinIDs, '{n}.'.$assocData['with'].'.'.$assocData['associationForeignKey'])
				);
			}
		}
	}

	/**
	 * For each HABTM association, using ids from $foreignTableIDs array find
	 * counts and update counter cache field in the associated table
	 *
	 * @param mixed $model
	 * @access private
	 * @return void
	 */
	function updateCounters(&$model) {
		foreach ($model->hasAndBelongsToMany as $assocKey => $assocData)
			if (isset($this->foreignTableIDs[$assocData['className']])
				&& $this->foreignTableIDs[$assocData['className']]) {

				$assocModel =& $model->{$assocData['className']};
				$joinModel =& $model->{$assocData['with']};

				$field = Inflector::underscore($model->name).'_count';

				if ($assocModel->hasField($field)) {
					$saveArr = array();

					// in case of delete $rawCounts array may be empty -- update associated model anyway
					foreach ($this->foreignTableIDs[$assocData['className']] as $assocId)
						$saveArr[$assocId] = array('id' => $assocId, $field => 0);

					// if 'unique' set to false - update counter cache with the number of only unique pairs
					$rawCounts = $joinModel->find('all', array(
						'fields' => array(
							$assocData['associationForeignKey'],
							($assocData['unique'] ? 'COUNT(*)' : 'COUNT(DISTINCT '.$assocData['associationForeignKey'].','.$assocData['foreignKey'].')')
							.' AS count'),
						'conditions' => array(
							$assocData['associationForeignKey'] => $this->foreignTableIDs[$assocData['className']]
						),
						'group' => $assocData['associationForeignKey']
					));

					$counts = Set::combine($rawCounts, '{n}.'.$assocData['with'].'.'.$assocData['associationForeignKey'], '{n}.0.count');

					// override $saveArr with count() data
					foreach ($counts as $assocId => $count)
						$saveArr[$assocId] = array('id' => $assocId, $field => $count);

					$assocModel->saveAll($saveArr, array(
						'validate' => false,
						'fieldList' => array($field),
						'callbacks' => false
					));
				}
			}
	}

	/**
	 * On update fill $foreignTableIDs for each HABTM association from user form data
	 *
	 * @param mixed $model
	 * @access public
	 * @return boolean
	 */
	function beforeSave(&$model) {
		if (! empty($model->id)) {
			// this is an update, we handle creates in afterSave(), this saves us some CPU cycles
			$this->findForeignIDs($model);

			foreach ($model->hasAndBelongsToMany as $assocKey => $assocData)
				if (isset($model->data[$assocData['className']])
					&& isset($model->data[$assocData['className']][$assocData['className']])
					&& is_array($model->data[$assocData['className']][$assocData['className']])) {

					$this->foreignTableIDs[$assocData['className']] = Set::merge(
						isset($this->foreignTableIDs[$assocData['className']]) ? $this->foreignTableIDs[$assocData['className']] : array(),
						$model->data[$assocData['className']][$assocData['className']]
					);
				}
		}

		return true;
	}

	/**
	 * Update counter cache after all data saved
	 *
	 * @param mixed $model
	 * @param boolean $created
	 * @access public
	 * @return void
	 */
	function afterSave(&$model, $created) {
		if ($created) {
			foreach ($model->hasAndBelongsToMany as $assocKey => $assocData) {
				$assocModel =& $model->{$assocData['className']};
				$field = Inflector::underscore($model->name).'_count';

				if ($assocModel->hasField($field))
					$this->foreignTableIDs[$assocData['className']] = $model->data[$assocData['className']][$assocData['className']];
			}
		}

		$this->updateCounters($model);

		foreach ($model->hasAndBelongsToMany as $assocKey => $assocData) {
			$field = Inflector::underscore($assocKey).'_count';

			if ($model->hasField($field)) {
				$joinModel =& $model->{$assocData['with']};

				// if 'unique' set to false - update counter cache with the number of only unique pairs
				$count = $joinModel->field(
					($assocData['unique'] ? 'COUNT(*)' : 'COUNT(DISTINCT '.$assocData['associationForeignKey'].')').' AS count',
					array($assocData['foreignKey'] => $model->id)
				);

				$model->saveField($field, $count, array(
					'validate' => false,
					'callbacks' => false
				));
			}
		}

		$this->foreignTableIDs = array();
	}

	/**
	 * Fill $foreignTableIDs array just before deletion
	 *
	 * @param mixed $model
	 * @access public
	 * @return boolean
	 */
	function beforeDelete(&$model) {
		$this->findForeignIDs($model);

		return true;
	}

	/**
	 * Update counter cache after deletion
	 *
	 * @param mixed $model
	 * @access public
	 * @return void
	 */
	function afterDelete(&$model) {
		$this->updateCounters($model);

		$this->foreignTableIDs = array();
	}
}
?> 
