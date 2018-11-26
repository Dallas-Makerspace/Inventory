<div class="categories index">
	<h2><?php __('Categories');?></h2>

<?php echo $this->Tree->show('Category/name', $categories, 'link'); ?>

<p><?php echo $this->Html->link('Show Top Level Categories Only',array('action'=>'index')); ?></p>

</div>
