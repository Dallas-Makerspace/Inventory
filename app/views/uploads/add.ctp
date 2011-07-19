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
<?php
	echo $this->Form->button(__('Submit', true), array('type'=>'submit','class'=>'primary left'));
	echo $this->Html->link(__('Cancel', true), array('controller' => 'items', 'action' => 'view', $this->data['Upload']['item_id']), array('class' => 'button negative right'));
	echo $this->Form->end();
?>
</div>
