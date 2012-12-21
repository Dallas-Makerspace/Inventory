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
	echo $this->Html->div('button-group',
		$this->Form->button(__('Submit'), array('type'=>'submit','class'=>'button primary icon approve'))
		. $this->Html->link(__('Cancel'), array('action' => 'view', $this->data['Item']['id']), array('class' => 'button danger'))
	);
	echo $this->Form->end();
?>
</div>

<?php
$page_actions = array(
	$this->Html->link(__('Delete Item', true), array('action' => 'delete', $this->data['Item']['id']), null, __('Are you sure you want to delete %s?', $this->data['Item']['name']))
);
$this->set(compact('page_actions'));
?>
