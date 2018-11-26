<div class="categories form">
<h2>Delete Category: <?php echo h($this->data['Category']['name']); ?></h2>
<?php echo $this->Form->create('Category');?>
	<?php
		echo $this->Form->hidden('id');
		echo $this->Form->input('option', array(
			'type' => 'radio',
			'options' => array(
				//'all'=>'Delete category, all child categories and all associated items',
				'children'=>'Delete category and all child categories, leaving all items',
				//'items'=>'Delete category and all associated items, leaving child categories and their items',
				'only'=>'Delete just this category, leaving all items and child categories',
			),
			'default' => 'only'
		));
	?>
	<p><strong>NOTE: This operation can not be undone!</strong></p>
<?php
	echo $this->Html->div('button-group',
		$this->Form->button(__('Submit'), array('type'=>'submit','class'=>'button primary icon approve'))
		. $this->Html->link(__('Cancel'), array('controller' => 'categories', 'action' => 'view', $this->data['Category']['id']), array('class' => 'button danger'))
	);
	echo $this->Form->end();
?>
</div>
