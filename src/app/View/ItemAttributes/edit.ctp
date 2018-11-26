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
	echo $this->Html->div('button-group',
		$this->Form->button(__('Submit'), array('type'=>'submit','class'=>'button primary icon approve'))
		. $this->Html->link(__('Cancel'), array('controller' => 'items', 'action' => 'view', $this->request->data['ItemAttribute']['item_id']), array('class' => 'button danger'))
	);
	echo $this->Form->end();
?>
</div>
