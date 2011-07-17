<div class="categories form">
<?php echo $this->Form->create('Category');?>
	<fieldset>
		<legend><?php __('Edit Category'); ?></legend>
	<?php
		echo $this->Form->input('parent_id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<?php
$page_actions = array(
	$this->Html->link(__('Delete Category', true), array('action' => 'delete', $this->Form->value('Category.id')))
);
$this->set(compact('page_actions'));
?>
