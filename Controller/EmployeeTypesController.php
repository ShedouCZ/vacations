<?php
App::uses('AppController', 'Controller');
class EmployeeTypesController extends AppController {
	public $layout = 'BootstrapCake.bootstrap';

	public $components = array('Paginator', 'Session');


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
