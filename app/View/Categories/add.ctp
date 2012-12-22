<div class="categories form">
<?php echo $this->Form->create('Category');?>
	<fieldset>
		<legend><?php echo __('New Category'); ?></legend>
	<?php
		echo $this->Form->input('parent_id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php
	echo $this->Html->div('button-group',
		$this->Form->button(__('Submit'), array('type'=>'submit','class'=>'button primary icon approve'))
		. $this->Html->link(__('Cancel'), array('controller' => 'categories', 'action' => 'index'), array('class' => 'button danger'))
	);
	echo $this->Form->end();
?>
</div>
