<div class="categories index">
	<h2><?php __('Categories');?></h2>

<p><?php echo $this->Html->link('Show All Categories',array('action'=>'all')); ?></p>

<ul>
<?php foreach($categories as $id=>$name): ?>
	<li><?php echo $this->Html->link($name,array('action'=>'view',$id)); ?></li>
<?php endforeach; ?>
</ul>

</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Category', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
