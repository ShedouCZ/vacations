<?php

if (($availableRoles = Cache::read('available_roles', APP_ROLE_CACHE)) === false) {
	$user = ClassRegistry::init('User');
	$availableRoles = $user->Role->find('list', array('fields' => array('alias', 'id')));

	// lowercasing as TinyAuthorize expects roles to be lowercased
	$availableRoles = array_change_key_case($availableRoles, $case=CASE_LOWER);
	Cache::write('available_roles', $availableRoles, APP_ROLE_CACHE);
}

$config['available_roles'] = $availableRoles;

// available roles locale
__('Anonymous');
__('Administrator');
