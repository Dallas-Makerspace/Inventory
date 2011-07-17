<div class="verifications form">
<?php echo $this->Form->create('Verification');?>
	<fieldset>
		<legend><?php __('Add Verification'); ?></legend>
	<?php
		echo $this->Form->hidden('item_id');
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
