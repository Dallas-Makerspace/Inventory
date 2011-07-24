<div class="items form">
<?php echo $this->Form->create('Item');?>
	<fieldset>
		<legend><?php __('Edit Item'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('room_id');
		echo $this->Form->input('location');
		echo $this->Form->input('owner');
		echo $this->Form->input('qty',array('label' => 'Quantity'));
		echo $this->Form->input('notes');
		echo $this->Form->input('Category');
	?>
	</fieldset>
<?php
	echo $this->Form->button(__('Submit', true), array('type'=>'submit','class'=>'primary left'));
	echo $this->Html->link(__('Cancel', true), array('action' => 'view', $this->data['Item']['id']), array('class' => 'button negative right'));
	echo $this->Form->end();
?>
</div>

<?php
$page_actions = array(
	$this->Html->link(__('Delete Item', true), array('action' => 'delete', $this->data['Item']['id']), null, sprintf(__('Are you sure you want to delete %s?', true), $this->data['Item']['name']))
);
$this->set(compact('page_actions'));
?>
