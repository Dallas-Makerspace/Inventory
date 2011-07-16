<div class="verifications form">
<?php echo $this->Form->create('Verification');?>
	<fieldset>
		<legend><?php __('Edit Verification'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('item_id');
		echo $this->Form->input('username');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Verification.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Verification.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Verifications', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>