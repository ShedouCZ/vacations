<?php
App::uses('AppController', 'Controller');
class ApiController extends AppController {
	public $components = array('Paginator', 'Session');
	public $uses = array('Vacation', 'User');

	public function get($id = null) {
		$vacations = $this->Vacation->find('all');
		//$users = $this->User->find('all', array('conditions'=>array('id'=>114)));
		$users = $this->User->find('all', array('order'=>'User.sn', 'conditions'=>array('disabled'=>0, 'not' => array('User.sn' => null))));
		
		$res = array(
			'vacations' => $vacations,
			'users' => $users,
		);
		
		if (!empty($this->request->params['requested'])) {
			return $res;
		}
		
		$res_json = json_encode($res);
		return new CakeResponse(array('body'=>$res_json));
	}
}
