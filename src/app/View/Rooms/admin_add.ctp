<div class="rooms form">
<?php echo $this->Form->create('Room');?>
	<fieldset>
		<legend><?php echo __('Add Room'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php
	echo $this->Html->div('button-group',
		$this->Form->button(__('Submit'), array('type'=>'submit','class'=>'button primary icon approve'))
		. $this->Html->link(__('Cancel'), array('controller' => 'rooms', 'action' => 'index'), array('class' => 'button danger'))
	);
	echo $this->Form->end();
?>
</div>
