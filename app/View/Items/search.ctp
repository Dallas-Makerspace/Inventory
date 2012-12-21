<div class="items search">
<h2><?php __('Search');?></h2>
<?php if(!empty($items)): ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('room_id');?></th>
			<th><?php echo $this->Paginator->sort('location');?></th>
			<th><?php echo $this->Paginator->sort('owner');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($items as $item):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $this->Html->link($item['Item']['name'], array('controller' => 'items', 'action' => 'view', $item['Item']['id'])); ?></td>
		<td><?php echo $this->Html->link($item['Room']['name'], array('controller' => 'rooms', 'action' => 'view', $item['Room']['id'])); ?></td>
		<td><?php echo $this->Html->link($item['Item']['location'], array('controller' => 'items', 'action' => 'search', 'location' => $item['Item']['location'])); ?></td>
		<td><?php echo $this->Html->link($item['Item']['owner'], array('controller' => 'items', 'action' => 'search', 'owner' => $item['Item']['owner'])); ?></td>
		<td><?php echo $item['Item']['qty']; ?></td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous '), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
<?php elseif(!empty($search_terms)): ?>
<p>No items were found matching those terms.</p>
<?php else: ?>
<p>You should try searching for something.</p>
<?php endif; ?>
</div>

