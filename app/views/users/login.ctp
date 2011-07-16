<?php
    echo $session->flash('auth');
    echo $this->Form->create('User', array('action' => 'login', 'name' => 'login'));
    echo $this->Form->input('username');
    echo $this->Form->input('password');
    echo $this->Form->button(__('Login', true), array('type'=>'submit'));
    echo $this->Form->end();
?>
