<div class="categories index">
	<h2><?php __('Categories');?></h2>

<ul>
<?php foreach($categories as $category): ?>
	<li>
	<?php
		echo $this->Html->link("{$category['Category']['name']}",array('action'=>'view',$category['Category']['id']));
		echo " [{$category['Category']['category_count']}] ({$category['Category']['item_count']})";
	?>
	</li>
<?php endforeach; ?>
</ul>

<p><?php echo $this->Html->link('Show All Categories',array('action'=>'all')); ?></p>

</div>
