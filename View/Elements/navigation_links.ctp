<?php
	$links = array(
		//'Requests' => '/requests',
		//'Reservations' => '/reservations',
		//'Confirmations' => '/confirmations',
		//'Booking' => '/bookings',
		'Vacation Types'  => '/admin/vacation_types',
		'Employee Types'  => '/admin/employee_types/types',
		'Users' => '/admin/users',
		'Roles' => '/admin/roles',
		//'Log' => '/log',
		//'' => '',
	);

	$user = AuthComponent::user();

	foreach ($links as $title => $url) {
		$link = $this->Html->link(__($title), $url);
		$options = array();
		if (1 || $this->Auth->is_allowed($url, $user) || $url == '/calendar' || $url == '/admin/vacation_types')  {		// till is_allowed checks Auth->allow('action') as well
			if (strpos($this->request->here, Router::url($url)) === 0) {							// detect query string + params
				$options = array('class' => 'active');
			}
			echo $this->Html->tag('li', $link, $options);
		}
	}
