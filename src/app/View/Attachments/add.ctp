<div class="attachments form">
<?php echo $this->Form->create('Attachment', array('type' => 'file'));?>
	<fieldset>
		<legend><?php echo __('Upload File'); ?></legend>
	<?php
		echo $this->Form->hidden('item_id');
		echo $this->Form->file('file');
		if ($this->Form->isFieldError('file')) {
			echo $this->Form->error('file');
		}
		if ($this->Form->isFieldError('name')) {
			echo $this->Form->error('name');
		}
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php
	echo $this->Html->div('button-group',
		$this->Form->button(__('Submit'), array('type'=>'submit','class'=>'button primary icon approve'))
		. $this->Html->link(__('Cancel'), array('controller' => 'items', 'action' => 'view', $this->passedArgs['item']), array('class' => 'button danger'))
	);
	echo $this->Form->end();
?>
</div>
