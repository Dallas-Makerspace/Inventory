<div class="items view">
<h2>Item: <?php echo h($item['Item']['name']); ?></h2>
<div style="float:right">
Item:<br />
<?php echo $this->Qrcode->url($this->Html->url(null,true),array('size' => '150x150','margin' => 0)); ?><br />
Location:<br />
<?php echo $this->Qrcode->url($this->Html->url(array('action' => 'search', 'location' => $item['Item']['location']),true),array('size' => '150x150','margin' => 0)); ?><br />
</div>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Function'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php
			$functions = explode(',',$item['Item']['function']);
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
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Manufacturer'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($item['Item']['manufacturer'],array('action' => 'search', 'manufacturer' => $item['Item']['manufacturer'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Room'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($item['Room']['name'], array('controller' => 'rooms', 'action' => 'view', $item['Room']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Location'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($item['Item']['location'],array('action' => 'search', 'location' => $item['Item']['location'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Owner'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($item['Item']['owner'],array('action' => 'search', 'owner' => $item['Item']['owner'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Qty'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $item['Item']['qty']; ?>
			&nbsp;
		</dd>
		
		<?php if (!empty($item['Category'])):?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Categories'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php
			foreach($item['Category'] as $category) {
				echo $this->Html->link($category['name'] . ' ',array('controller' => 'categories', 'action' => 'view', $category['id']));
			}
			?>
		</dd>
		<?php endif; ?>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $item['Item']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $item['Item']['modified']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Last Verified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php if(isset($item['Verification'][0]['created'])): ?>
			<?php echo $item['Verification'][0]['created']; ?> - <a href="#verifications">view log</a>
			<?php else: ?>
			<i>Never</i>
			<?php endif; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Notes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php
				if(!empty($item['Item']['notes'])) {
					echo str_replace("\n",'<br />',$this->Text->autoLink(h($item['Item']['notes'])));
				} else {
					echo '<i>None</i>';
				}
			?>
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php __('Files');?></h3>
		<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New File', true), array('controller' => 'uploads', 'action' => 'add', 'item' => $item['Item']['id']));?> </li>
		</ul>
		</div>
	<?php if (!empty($item['Upload'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Name'); ?></th>
		<th><?php __('Size'); ?></th>
		<th><?php __('Description'); ?></th>
		<th class="noprint"><?php __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['Upload'] as $upload):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $this->Html->link($upload['name'],'/files/'.$upload['name']);?></td>
			<td><?php echo $this->Number->toReadableSize($upload['size']); ?></td>
			<td><?php echo str_replace("\n",'<br />',$this->Text->autoLink(h($upload['description'])));?></td>
			<!-- <a href="#" class="negative button"><span class="trash icon"></span>Delete</a> -->
			<td class="noprint"><?php echo $this->Html->link(__('Delete', true),array('controller' => 'uploads', 'action' => 'delete', $upload['id']), null, sprintf(__('Are you sure you want to delete %s?', true), $upload['name'])); ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php else: ?>
	<p>No files have been uploaded for this item.</p>
	<?php endif; ?>
</div>

<div class="related">
	<h3><?php __('Comments');?></h3>
		<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Comment', true), array('controller' => 'comments', 'action' => 'add', 'item' => $item['Item']['id']));?> </li>
		</ul>
		</div>
	<?php if (!empty($item['Comment'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th style="width: 70px;"><?php __('Date'); ?></th>
		<th style="width: 120px;"><?php __('Username'); ?></th>
		<th><?php __('Message'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['Comment'] as $comment):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $comment['created'];?></td>
			<td><?php echo h($comment['username']);?></td>
			<td><?php echo str_replace("\n",'<br />',$this->Text->autoLink(h($comment['message'])));?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php else: ?>
	<p>No comments have been made on this item.</p>
	<?php endif; ?>
</div>

<div class="related">
	<a name="verifications"></a>
	<h3><?php __('Inventory Verifications');?></h3>
		<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Verification', true), array('controller' => 'verifications', 'action' => 'add', 'item' => $item['Item']['id']));?> </li>
		</ul>
		</div>
	<?php if (!empty($item['Verification'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th style="width: 70px;"><?php __('Date'); ?></th>
		<th style="width: 120px;"><?php __('Username'); ?></th>
		<th><?php __('Message'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['Verification'] as $verification):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $verification['created'];?></td>
			<td><?php echo h($verification['username']);?></td>
			<td><?php echo str_replace("\n",'<br />',$this->Text->autoLink(h($verification['comment'])));?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php else: ?>
	<p>No inventory verifications have been done for this item.</p>
	<?php endif; ?>
</div>

<?php
$page_actions = array(
	$this->Html->link(__('Edit Item', true), array('action' => 'edit', $item['Item']['id'])),
	$this->Html->link(__('Delete Item', true), array('action' => 'delete', $item['Item']['id']), null, sprintf(__('Are you sure you want to delete %s?', true), $item['Item']['name']))
);
$this->set(compact('page_actions'));
?>
