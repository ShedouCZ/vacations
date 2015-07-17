<?php
	$act_role = AuthComponent::user('act_role');
	$roles    = AuthComponent::user('Role');

	if (is_array($roles)) foreach ($roles as $role) {
		$link = $this->Html->link(__($role['alias']), "/users/switch_role/".$role['id']);
		echo $this->Html->tag('li', $link, (($role['id'] === $act_role) ? array('class' => 'active') : array()));
	}
