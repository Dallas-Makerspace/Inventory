<div class="items form">
<?php echo $this->Form->create('Item');?>
	<fieldset>
		<legend><?php __('Add Item'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('function');
		echo $this->Form->input('manufacturer');
		echo $this->Form->input('room_id');
		echo $this->Form->input('location');
		echo $this->Form->input('owner',array('default' => 'DMS'));
		echo $this->Form->input('qty',array('label' => 'Quantity'));
		echo $this->Form->input('notes');
		echo $this->Form->input('Category');
	?>
	</fieldset>
<?php
	echo $this->Form->button(__('Submit', true), array('type'=>'submit','class'=>'primary'));
	echo $this->Form->end();
?>
</div>
