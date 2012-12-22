<div class="comments form">
<?php echo $this->Form->create('Comment');?>
	<fieldset>
		<legend><?php echo __('Add Comment'); ?></legend>
	<?php
		echo $this->Form->hidden('item_id');
		echo $this->Form->input('message');
	?>
	</fieldset>
<?php
	echo $this->Html->div('button-group',
		$this->Form->button(__('Submit'), array('type'=>'submit','class'=>'button primary icon approve'))
		. $this->Html->link(__('Cancel'), array('controller' => 'items', 'action' => 'view', $this->request->data['Comment']['item_id']), array('class' => 'button danger'))
	);
	echo $this->Form->end();
?>
</div>
