<div class="attributes form">
<?php echo $this->Form->create('Attribute');?>
	<fieldset>
		<legend><?php __('Edit Attribute'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php
	echo $this->Form->button(__('Submit', true), array('type'=>'submit','class'=>'primary left'));
	echo $this->Html->link(__('Cancel', true), array('action' => 'view', $this->data['Attribute']['id']), array('class' => 'button negative right'));
	echo $this->Form->end();
?>
</div>

<?php
$page_actions = array(
	$this->Html->link(__('Delete Attribute', true), array('action' => 'delete', $this->Form->value('Attribute.id')))
);
$this->set(compact('page_actions'));
?>
