<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<title><?php echo $title_for_layout; ?> - DMS Inventory</title>

<?php
	echo $this->Html->meta('icon') . "\n";
	echo $this->Html->css('straightblack') . "\n";
	echo $this->Html->css('cake.modified') . "\n";
	echo $this->Html->css('css3buttons') . "\n";
	echo $this->Html->css('straightblack-print','stylesheet',array('media' => 'print')) . "\n";
	echo $scripts_for_layout;
?>

</head>
<body>

<div id="wrap">


<div id="header">
<h1><?php echo $this->Html->link(__('Dallas Makerspace Inventory', true), array('controller' => 'categories', 'action' => 'index'));?></h1>
</div>

<div id="menu">
<ul>
<li><?php echo $this->Html->link(__('Inventory', true), array('controller' => 'categories', 'action' => 'index'));?></li>
<li><?php echo $this->Html->link(__('Wiki', true), 'http://dallasmakerspace.org/wiki');?></li>
<li><?php echo $this->Html->link(__('Blog', true), 'http://dallasmakerspace.org/blog');?></li>
<li><?php echo $this->Html->link(__('Forums', true), 'http://dallasmakerspace.org/forums');?></li>
<li class="right"><?php echo $this->Html->link(__('Help', true), array('controller' => 'pages', 'action' => 'display', 'help'));?></li>
<?php if(isset($uid)): ?>
<li class="right"><?php echo $this->Html->link(__('Logout', true), array('controller' => 'users', 'action' => 'logout'));?></li>
<?php else: ?>
<li class="right"><?php echo $this->Html->link(__('Login', true), array('controller' => 'users', 'action' => 'login'));?></li>
<?php endif; ?>
</ul>
</div>

<div id="contentwrap"> 

<div id="content">

<?php echo $this->Session->flash(); ?>

<?php echo $content_for_layout; ?>

<div class="printonly">
<h3>QR code for this page:</h3>
<?php echo $this->Qrcode->url($this->Html->url(null,true),array('size' => '150x150','margin' => 0)); ?>
</div>

</div>

<?php if(isset($uid)): ?>
<div id="sidebar">
	<?php echo $this->element('navigation', array('cache' => true)); ?>
	<?php echo $this->element('actions', array('cache' => true)); ?>
</div>
<?php endif; ?>

<div style="clear: both;"> </div>

</div>

<div id="footer">
<p><a href="https://github.com/Dallas-Makerspace/Dallas-Makerspace-Inventory">Source code on GitHub</a> | Content is available under <a href="http://creativecommons.org/licenses/by-sa/3.0/" class="external ">Attribution-Share Alike 3.0 Unported</a> | Template by <a href="http://www.templatestable.com">Free Css Templates</a></p>
</div>

</div>
<div class="debug">
	<?php echo $this->element('sql_dump'); ?>
</div>
</body>
</html>
