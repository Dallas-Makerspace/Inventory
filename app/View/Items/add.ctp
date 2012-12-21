<div class="items form">
<?php echo $this->Form->create('Item');?>
	<fieldset>
		<legend><?php __('Add Item'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('room_id');
		echo $this->Form->input('location');
		echo $this->Form->input('owner',array('default' => 'DMS'));
		echo $this->Form->input('qty',array('label' => 'Quantity'));
		echo $this->Form->input('notes');
		echo $this->Form->input('Category');
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
