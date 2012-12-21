<div class="rooms view">
<h2><?php echo h($room['Room']['name']) ?></h2>
</div>
<div class="related">
	<?php if (!empty($room['Item'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Name'); ?></th>
		<th><?php __('Location'); ?></th>
		<th><?php __('Owner'); ?></th>
		<th><?php __('Qty'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($room['Item'] as $item):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $this->Html->link($item['name'], array('controller' => 'items', 'action' => 'view', $item['id'])); ?></td>
			<td><?php echo $this->Html->link($item['location'], array('controller' => 'items', 'action' => 'search', 'location' => $item['location'])); ?></td>
			<td><?php echo $this->Html->link($item['owner'], array('controller' => 'items', 'action' => 'search', 'owner' => $item['owner'])); ?></td>
			<td><?php echo $item['qty'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php else: ?>
	<p>There are no items in this room. If this differs from reality, disregard reality.</p>
	<?php endif; ?>
</div>
<?php
$page_admin_actions = array(
	$this->Html->link(__('Edit Room', true), array('admin' => true, 'action' => 'edit', $room['Room']['id'])),
	$this->Form->postLink(__('Delete Room', true), array('admin' => true, 'action' => 'delete', $room['Room']['id']), null, __('Are you sure you want to delete %s?', $room['Room']['name'])),
);
$this->set(compact('page_admin_actions'));
?>
