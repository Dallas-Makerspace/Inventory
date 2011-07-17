<div class="uploads form">
<?php echo $this->Form->create('Upload', array('type' => 'file'));?>
	<fieldset>
		<legend><?php __('Add File'); ?></legend>
	<?php
		echo $this->Form->hidden('item_id');
		echo $this->Form->input('file', array('type' => 'file'));
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
