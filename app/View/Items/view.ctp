<div class="items view">
<h2>Item: <?php echo h($item['Item']['name']); ?></h2>
<div style="float:right">
Item:<br />
<?php echo $this->Qrcode->url($this->Html->url(null,true),array('size' => '150x150','margin' => 0)); ?><br />
Location:<br />
<?php echo $this->Qrcode->url($this->Html->url(array('action' => 'search', 'location' => $item['Item']['location']),true),array('size' => '150x150','margin' => 0)); ?><br />
</div>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Room'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($item['Room']['name'], array('controller' => 'rooms', 'action' => 'view', $item['Room']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Location'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($item['Item']['location'],array('action' => 'search', 'location' => $item['Item']['location'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Owner'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($item['Item']['owner'],array('action' => 'search', 'owner' => $item['Item']['owner'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Qty'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $item['Item']['qty']; ?>
			&nbsp;
		</dd>
		
		<?php if (!empty($item['Category'])):?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Categories'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php
			foreach($item['Category'] as $category) {
				echo $this->Html->link($category['name'] . ' ',array('controller' => 'categories', 'action' => 'view', $category['id']));
			}
			?>
		</dd>
		<?php endif; ?>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $item['Item']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $item['Item']['modified']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Last Verified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php if(isset($item['Verification'][0]['created'])): ?>
			<?php echo $item['Verification'][0]['created']; ?> - <a href="#verifications">view log</a>
			<?php else: ?>
			<i>Never</i>
			<?php endif; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Notes'); ?></dt>
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
	<h3><?php echo __('Attributes');?></h3>
		<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Attribute', true), array('controller' => 'item_attributes', 'action' => 'add', 'item' => $item['Item']['id']));?> </li>
		</ul>
		</div>
	<?php if (!empty($item['ItemAttribute'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Attribute'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th class="noprint"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['ItemAttribute'] as $attribute):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo h($attribute['Attribute']['name']);?></td>
			<td><?php echo $this->Html->link(
				$attribute['value'],
				array('controller' => 'items', 'action' => 'search',
					strtolower($attribute['Attribute']['name']) => strtolower($attribute['value']))
				); ?>
			</th>
			<td class="noprint">
				<?php echo $this->Html->link(__('Edit',true),array('controller' => 'item_attributes', 'action' => 'edit', $attribute['id'])); ?>&nbsp;
				<?php echo $this->Form->postLink(__('Delete', true),array('controller' => 'item_attributes', 'action' => 'delete', $attribute['id']), null, __('Are you sure you want to delete %s?', $attribute['Attribute']['name'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php else: ?>
	<p>No additional attributes have been added to this item.</p>
	<?php endif; ?>
</div>
<div class="related">
	<h3><?php echo __('Files');?></h3>
		<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New File', true), array('controller' => 'attachments', 'action' => 'add', 'item' => $item['Item']['id']));?> </li>
		</ul>
		</div>
	<?php if (!empty($item['Attachment'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Size'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th class="noprint"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['Attachment'] as $file):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $this->Html->link($file['name'],array('controller' => 'attachments', 'action' => 'view', $file['id'], $file['name']));?></td>
			<td><?php echo $this->Number->toReadableSize($file['size']); ?></td>
			<td><?php echo str_replace("\n",'<br />',$this->Text->autoLink(h($file['description'])));?></td>
			<!-- <a href="#" class="negative button"><span class="trash icon"></span>Delete</a> -->
			<td class="noprint"><?php echo $this->Form->postLink(__('Delete', true),array('controller' => 'attachments', 'action' => 'delete', $file['id']), null, __('Are you sure you want to delete %s?', $file['name'])); ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php else: ?>
	<p>No files have been uploaded for this item.</p>
	<?php endif; ?>
</div>

<div class="related">
	<h3><?php echo __('Comments');?></h3>
		<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Comment', true), array('controller' => 'comments', 'action' => 'add', 'item' => $item['Item']['id']));?> </li>
		</ul>
		</div>
	<?php if (!empty($item['Comment'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Message'); ?></th>
		<?php if(in_array('admins',$user['User']['groups'])): ?>
			<th><?php echo __('Delete'); ?></th>
		<?php endif; ?>
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
			<td><?php echo $this->Time->niceShort($comment['created']);?></td>
			<td><?php echo h($comment['username']);?></td>
			<td><?php echo str_replace("\n",'<br />',$this->Text->autoLink(h($comment['message'])));?></td>
			<?php if(in_array('admins',$user['User']['groups'])): ?>
				<td><?php echo $this->Form->postLink('x', array('controller' => 'comments', 'action' => 'delete', $comment['id'], 'admin' => true),array('type'=>'submit','class'=>'button danger primary'), __('Are you sure you want to delete by %s?', $comment['username'])); ?></td>
			<?php endif; ?>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php else: ?>
	<p>No comments have been made on this item.</p>
	<?php endif; ?>
</div>

<div class="related">
	<a name="verifications"></a>
	<h3><?php echo __('Inventory Verifications');?></h3>
		<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Verification', true), array('controller' => 'verifications', 'action' => 'add', 'item' => $item['Item']['id']));?> </li>
		</ul>
		</div>
	<?php if (!empty($item['Verification'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Message'); ?></th>
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
			<td><?php echo $this->Time->niceShort($verification['created']);?></td>
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
	$this->Form->postLink(__('Delete Item', true), array('action' => 'delete', $item['Item']['id']), null, __('Are you sure you want to delete %s?', $item['Item']['name']))
);
$this->set(compact('page_actions'));
?>
