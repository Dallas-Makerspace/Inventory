<div class="verifications form">
<?php echo $this->Form->create('Verification');?>
	<fieldset>
		<legend><?php __('Add Verification'); ?></legend>
	<?php
		echo $this->Form->hidden('item_id');
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php
	echo $this->Form->button(__('Submit', true), array('type'=>'submit','class'=>'primary left'));
	echo $this->Html->link(__('Cancel', true), array('controller' => 'items', 'action' => 'view', $this->data['Verification']['item_id']), array('class' => 'button negative right'));
	echo $this->Form->end();
?>
</div>
