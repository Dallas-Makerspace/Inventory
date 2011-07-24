<div class="attributes view">
<h2><?php __('Attribute: '); echo h($attribute['Attribute']['name']); ?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attribute['Attribute']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($attribute['Attribute']['name']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item Count'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attribute['Attribute']['item_count']; ?>
			&nbsp;
		</dd>
	</dl>
</div>

<!--

TODO: Show items here, not ItemAttributes

<div class="related">
	<h3><?php __('Related Item Attributes');?></h3>
	<?php if (!empty($attribute['ItemAttribute'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Item Id'); ?></th>
		<th><?php __('Attribute Id'); ?></th>
		<th><?php __('Value'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($attribute['ItemAttribute'] as $itemAttribute):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $itemAttribute['id'];?></td>
			<td><?php echo $itemAttribute['item_id'];?></td>
			<td><?php echo $itemAttribute['attribute_id'];?></td>
			<td><?php echo $itemAttribute['value'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'item_attributes', 'action' => 'view', $itemAttribute['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'item_attributes', 'action' => 'edit', $itemAttribute['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'item_attributes', 'action' => 'delete', $itemAttribute['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $itemAttribute['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Item Attribute', true), array('controller' => 'item_attributes', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
-->

<?php
$page_actions = array(
	$this->Html->link(__('Edit Attribute', true), array('action' => 'edit', $attribute['Attribute']['id'])),
	$this->Html->link(__('Delete Attribute', true), array('action' => 'delete', $attribute['Attribute']['id'])),
);
$this->set(compact('page_actions'));
?>
