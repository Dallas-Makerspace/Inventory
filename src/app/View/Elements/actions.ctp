<h3>Actions</h3>
<ul>
	<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items','action' => 'add')); ?></li>
	<li><?php echo $this->Html->link(__('New Category', true), array('controller' => 'categories','action' => 'add')); ?></li>
<?php if(isset($page_actions)): ?>
	<?php foreach($page_actions as $action): ?>
		<li><?php echo $action ?></li>
	<?php endforeach; ?>
<?php endif; ?>
<?php if(in_array('admins',$user['User']['groups'])): ?>
	<li><?php echo $this->Html->link(__('New Room', true), array('controller' => 'rooms', 'action' => 'add', 'admin' => true)); ?></li>
	<li><?php echo $this->Html->link(__('View Log', true), array('controller' => 'pages', 'action' => 'home')); ?></li>
	<?php if(isset($page_admin_actions)): ?>
		<?php foreach($page_admin_actions as $action): ?>
			<li><?php echo $action ?></li>
		<?php endforeach; ?>
	<?php endif; ?>
<?php endif; ?>
</ul>
