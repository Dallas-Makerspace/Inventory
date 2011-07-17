<h3>Actions</h3>
<ul>
	<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items','action' => 'add')); ?></li>
	<li><?php echo $this->Html->link(__('New Category', true), array('controller' => 'categories','action' => 'add')); ?></li>
<?php if(isset($page_actions)): ?>
	<?php foreach($page_actions as $action): ?>
		<li><?php echo $action ?></li>
	<?php endforeach; ?>
<?php endif; ?>
</ul>
