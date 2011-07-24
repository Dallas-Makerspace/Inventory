<div class="attributes form">
<?php echo $this->Form->create('Attribute');?>
	<fieldset>
		<legend><?php __('Add Attribute'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php
	echo $this->Form->button(__('Submit', true), array('type'=>'submit','class'=>'primary'));
	echo $this->Form->end();
?>
</div>
