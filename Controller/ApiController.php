<?php
App::uses('AppController', 'Controller');
class ApiController extends AppController {
	public $components = array('Paginator', 'Session');
	public $uses = array('Vacation', 'User');

	public function get($id = null) {
		$vacations = $this->Vacation->find('all');
		$users = $this->User->find('all');
		
		$res = array(
			'vacations' => $vacations,
			'users' => $users,
		);
		
		return new CakeResponse(array('body'=>json_encode($res)));
	}
}
