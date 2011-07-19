<div class="comments form">
<?php echo $this->Form->create('Comment');?>
	<fieldset>
		<legend><?php __('Add Comment'); ?></legend>
	<?php
		echo $this->Form->hidden('item_id');
		echo $this->Form->input('message');
	?>
	</fieldset>
<?php
	echo $this->Form->button(__('Submit', true), array('type'=>'submit','class'=>'primary left'));
	echo $this->Html->link(__('Cancel', true), array('controller' => 'items', 'action' => 'view', $this->data['Comment']['item_id']), array('class' => 'button negative right'));
	echo $this->Form->end();
?>
</div>
