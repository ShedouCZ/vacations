<?php
App::uses('AppController', 'Controller');
class EmployeeTypesController extends AppController {
	public $layout = 'BootstrapCake.bootstrap';
	public $components = array('Paginator', 'Session');
	public $uses = array('EmployeeType', 'User');

	public function admin_types() {
		if ($this->request->is('post')) {
			$this->User->save($this->request->data);
			exit();
		} else {
			$users = $this->User->find('all', array('order'=>'User.sn'));
			$users_by_type = Hash::combine($users, '{n}.User.id', '{n}.User', '{n}.User.employee_type_id');
			$types = $this->EmployeeType->find('list');
			$type_info = $this->EmployeeType->find('list', array('fields'=>array('id', 'days')));
			$types = array('Nenastaveno') + $types;
			// beware: items with type_id == null will gather under index of '0'
			$this->set(compact(array('users_by_type','types', 'type_info')));
		}
	}

	public function admin_index() {
		$this->EmployeeType->recursive = 0;
		$this->set('employeeTypes', $this->Paginator->paginate());
	}

	public function admin_reorder() {
		if ($this->request->is('post')) {
			$this->EmployeeType->saveMany($this->request->data);
			exit();
		}
		$this->set('employeeTypes', $this->EmployeeType->find('all'));
	}

	public function admin_view($id = null) {
		if (!$this->EmployeeType->exists($id)) {
			throw new NotFoundException(__('Invalid employee type'));
		}
		$options = array('conditions' => array('EmployeeType.' . $this->EmployeeType->primaryKey => $id));
		$this->set('employeeType', $this->EmployeeType->find('first', $options));
	}

	public function admin_add() {
		if ($this->request->is('post')) {
			$this->EmployeeType->create();
			if ($this->EmployeeType->save($this->request->data)) {
				$this->Session->setFlash(__('The employee type has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The employee type could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
	}

	public function admin_edit($id = null) {
		if (!$this->EmployeeType->exists($id)) {
			throw new NotFoundException(__('Invalid employee type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EmployeeType->save($this->request->data)) {
				$this->Session->setFlash(__('The employee type has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The employee type could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('EmployeeType.' . $this->EmployeeType->primaryKey => $id));
			$this->request->data = $this->EmployeeType->find('first', $options);
		}
	}

	public function admin_delete($id = null) {
		$this->EmployeeType->id = $id;
		if (!$this->EmployeeType->exists()) {
			throw new NotFoundException(__('Invalid employee type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->EmployeeType->delete()) {
			$this->Session->setFlash(__('The employee type has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The employee type could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
