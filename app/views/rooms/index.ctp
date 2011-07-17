<div class="rooms index">
	<h2><?php __('Rooms');?></h2>
	<ul>
	<?php foreach($rooms as $room): ?>
		<li>
		<?php
		echo $this->Html->link($room['Room']['name'],array('action' => 'view', $room['Room']['id']));
		$count = count($room['Item']);
		if($count == 1) {
			echo " - $count item";
		} elseif($count > 1) {
			echo " - $count items";
		}
		?>
		</li>
	<?php endforeach; ?>
	</ul>
</div>
