<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<title><?php echo $title_for_layout; ?></title>

<?php
	echo $this->Html->meta('icon') . "\n";
	echo $this->Html->css('straightblack') . "\n";
	echo $this->Html->css('cake.modified') . "\n";
	echo $this->Html->css('css3buttons') . "\n";
	echo $scripts_for_layout;
?>

</head>
<body>

<div id="wrap">


<div id="header">
<h1><?php echo $this->Html->link(__('Dallas Makerspace Voting', true), array('controller' => 'ballots', 'action' => 'index'));?></h1>
</div>

<div id="menu">
<ul>
<li><?php echo $this->Html->link(__('Open Ballots', true), array('controller' => 'ballots', 'action' => 'index', 'open'));?></li>
<li><?php echo $this->Html->link(__('Future Ballots', true), array('controller' => 'ballots', 'action' => 'index', 'future'));?></li>
<li><?php echo $this->Html->link(__('Closed Ballots', true), array('controller' => 'ballots', 'action' => 'index', 'closed'));?></li>
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

</div>

<div id="sidebar">
<h3>Main Content</h3>
<ul>
<li><a href="#">Conflantur</a></li>
<li><a href="#">Externarum vi</a></li>
<li><a href="#">Essem paulo</a></li>
<li><a href="#">Aeque fecto ii</a></li>
<li><a href="#">Quo locis utens</a></li>
</ul>

<h3>Related Web Sites</h3>
<ul>
<li><a href="#">Plus vi</a></li>
<li><a href="#">Agi praecise</a></li>
<li><a href="#">Infinitum veritates</a></li>
<li><a href="#">Corporea ac perpauca</a></li>
<li><a href="#">Aeque fecto</a></li>
</ul>

<h3>Lorem Ipsum</h3>
<ul>
<li><a href="#">Integer leo lectus</a></li>
<li><a href="#">Phasellus</a></li>
<li><a href="#">Fusce leo nisi</a></li>
<li><a href="#">Aenean quis</a></li>
<li><a href="#">Maecenas</a></li>
<li><a href="#">Etiam sit amet</a></li>
<li><a href="#">Nulla mattis</a></li>
<li><a href="#">Venturum ex dubitare</a></li>
</ul>

</div>

<div style="clear: both;"> </div>

</div>

<div id="footer">
<p><a href="https://github.com/aceat64/Dallas-Makerspace-Voting">Source code on GitHub</a> | Content is available under <a href="http://creativecommons.org/licenses/by-sa/3.0/" class="external ">Attribution-Share Alike 3.0 Unported</a> | Template by <a href="http://www.templatestable.com">Free Css Templates</a></p>
</div>

</div>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>
