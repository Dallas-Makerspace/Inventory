<div class="categories view">
<h2>
<?php
	echo $this->Html->link(__('Categories'),array('action'=>'index')).': ';
foreach($path as $parent) {
	echo '/'.$this->Html->link($parent['Category']['name'],array('action'=>'view',$parent['Category']['id']));
}
?>
</h2>
<?php if(!empty($children)): ?>
	<ul>
		<?php foreach($children as $child): ?>
		<li>
		<?php
			echo $this->Html->link("{$child['Category']['name']}",array('action'=>'view',$child['Category']['id']));
			echo " [{$child['Category']['category_count']}] ({$child['Category']['item_count']})";
		?>
		</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
</div>
<div class="related">
	<h3><?php echo __('Items'); ?> (<?php echo $category['Category']['item_count']; ?>)</h3>
	<?php if (!empty($category['Item'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Room'); ?></th>
		<th><?php echo __('Location'); ?></th>
		<th><?php echo __('Owner'); ?></th>
		<th><?php echo __('Qty'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($category['Item'] as $item):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $this->Html->link($item['name'], array('controller' => 'items', 'action' => 'view', $item['id'])); ?></td>
			<td><?php echo $this->Html->link($item['Room']['name'],array('controller'=>'rooms','action'=>'view',$item['Room']['id']));?></td>
			<td><?php echo $this->Html->link($item['location'], array('controller' => 'items', 'action' => 'search', 'location' => $item['location'])); ?></td>
			<td><?php echo $this->Html->link($item['owner'], array('controller' => 'items', 'action' => 'search', 'owner' => $item['owner'])); ?></td>
			<td><?php echo $item['qty'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php else: ?>
	<p>There are no items in this category.</p>
	<?php endif; ?>
</div>

<?php
$page_actions = array(
	$this->Html->link(__('Edit Category'), array('action' => 'edit', $category['Category']['id'])),
	$this->Html->link(__('Delete Category'), array('action' => 'delete', $category['Category']['id'])),
);
$this->set(compact('page_actions'));
?>
