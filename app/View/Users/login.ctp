<h2>Login</h2>
<?php echo $this->Form->create('User');?>
	<fieldset>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php
	echo $this->Html->div('button-group',
		$this->Form->button(__('Login'), array('type'=>'submit','class'=>'button primary icon approve'))
		. $this->Html->link(__('Cancel'), array('controller' => 'pages', 'action' => 'display', 'home'), array('class' => 'button danger'))
	);
	echo $this->Form->end();
?>
