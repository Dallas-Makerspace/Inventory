<div class="categories index">
	<h2><?php __('Categories');?></h2>

<p><?php echo $this->Html->link('Show Top Level Categories Only',array('action'=>'index')); ?></p>

<p><?php echo $tree->show('Category/name', $categories, 'link'); ?></p>

</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Category', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
