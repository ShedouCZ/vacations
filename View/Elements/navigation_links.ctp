<?php
	$links = array(
		//'Requests' => '/requests',
		//'Reservations' => '/reservations',
		//'Confirmations' => '/confirmations',
		//'Booking' => '/bookings',
		'Vacation Types'  => '/vacation_types',
		'Employee Types'  => '/employee_types/types',
		'Users' => '/users',
		'Roles' => '/roles',
		//'Log' => '/log',
		//'' => '',
	);

	$user = AuthComponent::user();

	foreach ($links as $title => $url) {
		$link = $this->Html->link(__($title), $url);
		$options = array();
		if ($this->Auth->is_allowed($url, $user))  {		// till is_allowed checks Auth->allow('action') as well
			if (strpos($this->request->here, Router::url($url)) === 0) {							// detect query string + params
				$options = array('class' => 'active');
			}
			echo $this->Html->tag('li', $link, $options);
		}
	}
