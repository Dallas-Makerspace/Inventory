<div class="itematttributes form">
<?php echo $this->Form->create('ItemAttribute');?>
	<fieldset>
		<legend><?php __('Add Attribute to Item'); ?></legend>
	<?php
		echo $this->Form->hidden('item_id');
		echo $this->Form->input('attribute_id');
		echo $this->Form->input('value');
	?>
	</fieldset>
<?php
	echo $this->Form->button(__('Submit', true), array('type'=>'submit','class'=>'primary left'));
	echo $this->Html->link(__('Cancel', true), array('controller' => 'items', 'action' => 'view', $this->data['ItemAttribute']['item_id']), array('class' => 'button negative right'));
	echo $this->Form->end();
?>
</div>
