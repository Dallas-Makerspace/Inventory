<div class="rooms view">
<h2><?php echo h($room['Room']['name']) ?> Room</h2>
</div>
<div class="related">
	<?php if (!empty($room['Item'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Name'); ?></th>
		<th><?php __('Function'); ?></th>
		<th><?php __('Manufacturer'); ?></th>
		<th><?php __('Location'); ?></th>
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
			<td>
				<?php
				$functions = explode(',',$item['function']);
				$first = true;
				foreach($functions as $function) {
					if($first) {
						$first = false;
					} else {
						echo ', ';
					}
					echo $this->Html->link($function, array('controller' => 'items', 'action' => 'search', 'function' => trim($function)));
				}
				?>
			</td>
			<td><?php echo $this->Html->link($item['manufacturer'], array('controller' => 'items', 'action' => 'search', 'manufacturer' => $item['manufacturer'])); ?></td>
			<td><?php echo $this->Html->link($item['location'], array('controller' => 'items', 'action' => 'search', 'location' => $item['location'])); ?></td>
			<td><?php echo $item['qty'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php else: ?>
	<p>There are no items in this room. If this differs from reality, disregard reality.</p>
	<?php endif; ?>
</div>
