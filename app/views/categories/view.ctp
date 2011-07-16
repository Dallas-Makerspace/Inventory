<div class="categories view">
<h2><?php  __('Category');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Path'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php
			//echo '/'.$this->Html->link("[Root]",array('action'=>'index'));
			foreach($path as $parent) {
				//echo "&nbsp;-&gt;&nbsp;";
				echo '/'.$this->Html->link($parent['Category']['name'],array('action'=>'view',$parent['Category']['id']));
			} ?>
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $category['Category']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Items'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $category['Category']['item_count']; ?>
			&nbsp;
		</dd>
	</dl>
	<h3>Child Categories</h3>
	<ul>
		<?php foreach($children as $child): ?>
		<li><?php echo $this->Html->link($child['Category']['name'],array('action'=>'view',$child['Category']['id'])); ?></li>
		<?php endforeach; ?>
	</ul>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Category', true), array('action' => 'edit', $category['Category']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Category', true), array('action' => 'delete', $category['Category']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $category['Category']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Items');?></h3>
	<?php if (!empty($category['Item'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Name'); ?></th>
		<th><?php __('Function'); ?></th>
		<th><?php __('Manufacturer'); ?></th>
		<th><?php __('Room'); ?></th>
		<th><?php __('Location'); ?></th>
		<th><?php __('Qty'); ?></th>
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
			<td><?php echo $this->Html->link($item['function'], array('controller' => 'items', 'action' => 'search', 'function' => $item['function'])); ?></td>
			<td><?php echo $this->Html->link($item['manufacturer'], array('controller' => 'items', 'action' => 'search', 'manufacturer' => $item['manufacturer'])); ?></td>
			<td><?php echo $this->Html->link($item['Room']['name'],array('controller'=>'rooms','action'=>'view',$item['Room']['id']));?></td>
			<td><?php echo $item['location'];?></td>
			<td><?php echo $item['qty'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Item', true), array('controller' => 'items', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
