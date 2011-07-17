<?php $all_categories = $this->requestAction('categories/getAllCategories'); ?>
<h3>Search</h3>
<?php
	echo $this->Form->create('Item',array('type' => 'get', 'action' => 'search'));
	echo $this->Form->text('search');
	echo $this->Form->end(array('style' => 'display:none'));
?>
<h3>Navigation</h3>
<form action="../">
<select onchange="window.open(this.options[this.selectedIndex].value,'_top')">
	<option value="">Choose a category...</option>
<?php foreach($all_categories as $id=>$name): ?>
	<option value="<?php echo $this->Html->url(array('controller' => 'categories', 'action' => 'view', $id)); ?>"><?php echo $name; ?></option>
<?php endforeach; ?>
</select>
</form>
<ul>
	<li><?php echo $this->Html->link(__('Categories', true), array('controller' => 'categories','action' => 'index')); ?></li>
	<li><?php echo $this->Html->link(__('Rooms', true), array('controller' => 'rooms','action' => 'index')); ?></li>
</ul>
