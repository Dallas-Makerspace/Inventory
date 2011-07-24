<div class="itematttributes form">
<?php echo $this->Form->create('ItemAttribute');?>
	<fieldset>
		<legend><?php __('Edit'); echo " {$attribute['Attribute']['name']} for {$item['Item']['name']}"; ?></legend>
	<?php
		echo $this->Form->hidden('item_id');
		echo $this->Form->input('value');
	?>
	</fieldset>
<?php
	echo $this->Form->button(__('Submit', true), array('type'=>'submit','class'=>'primary left'));
	echo $this->Html->link(__('Cancel', true), array('controller' => 'items', 'action' => 'view', $this->data['ItemAttribute']['item_id']), array('class' => 'button negative right'));
	echo $this->Form->end();
?>
</div>
