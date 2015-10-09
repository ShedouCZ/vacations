<?php
App::uses('AppController', 'Controller');
class ApiController extends AppController {
	public $components = array('Paginator', 'Session');
	public $uses = array('Vacation', 'User', 'EmployeeType', 'VacationType');

	public function get($id = null) {
		//$this->Vacation->recursive = 0;
		$vacations = $this->Vacation->find('all', array(
			'fields'=>array('id', 'title', 'start', 'end', 'vacation_type_id', 'user_id')
		));

		$this->User->recursive = -1;
		//$users = $this->User->find('all', array('conditions'=>array('id'=>114)));
		$users = $this->User->find('all', array(
			'order'=>'User.sn',
			'conditions'=>array('disabled'=>0, 'not' => array('User.sn' => null)),
			'fields'=>array('id', 'employee_type_id', 'fullname')
		));

		$employee_types = $this->EmployeeType->find('all', array(
			'fields'=>array('id', 'color', 'days')
		));
		$employee_types = Hash::combine($employee_types,'{n}.EmployeeType.id','{n}.EmployeeType');

		$vacation_types = $this->VacationType->find('all', array(
		));
		$vacation_types = Hash::combine($vacation_types,'{n}.VacationType.id','{n}.VacationType');

		$res = array(
			'vacations' => $vacations,
			'users' => $users,
			'employee_types' => $employee_types,
			'vacation_types' => $vacation_types,
		);

		if (!empty($this->request->params['requested'])) {
			return $res;
		}

		$res_json = json_encode($res);
		return new CakeResponse(array('body'=>$res_json));
	}
}
