<div class="verifications form">
<?php echo $this->Form->create('Verification');?>
	<fieldset>
		<legend><?php echo __('Inventory Verification'); ?></legend>
		<p>You are verifying that the information for this item is currently correct.<p>
		<dl><?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Name'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo h($item['Item']['name']); ?>
				&nbsp;
			</dd>
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
		</dl>
	<?php
		echo $this->Form->hidden('item_id');
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php
	echo $this->Html->div('button-group',
		$this->Form->button(__('Submit'), array('type'=>'submit','class'=>'button primary icon approve'))
		. $this->Html->link(__('Cancel'), array('controller' => 'items', 'action' => 'view', $this->request->data['Verification']['item_id']), array('class' => 'button danger'))
	);
	echo $this->Form->end();
?>
</div>
