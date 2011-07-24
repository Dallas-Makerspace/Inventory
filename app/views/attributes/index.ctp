<div class="attributes index">
	<h2><?php __('Attributes');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('item_count');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($attributes as $attribute):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $attribute['Attribute']['id']; ?>&nbsp;</td>
		<td><?php echo $attribute['Attribute']['name']; ?>&nbsp;</td>
		<td><?php echo $attribute['Attribute']['item_count']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $attribute['Attribute']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $attribute['Attribute']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $attribute['Attribute']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $attribute['Attribute']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Attribute', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Item Attributes', true), array('controller' => 'item_attributes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item Attribute', true), array('controller' => 'item_attributes', 'action' => 'add')); ?> </li>
	</ul>
</div>