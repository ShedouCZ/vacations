<?php
App::uses('AppController', 'Controller');
class VacationsController extends AppController {
	public $layout = 'BootstrapCake.bootstrap';

	public $components = array('Paginator', 'Session');

	public function admin_index() {
		$this->Vacation->recursive = 0;
		$this->set('vacations', $this->Paginator->paginate());
	}
	
	public function calendar() {
		
	}

	public function admin_view($id = null) {
		if (!$this->Vacation->exists($id)) {
			throw new NotFoundException(__('Invalid vacation'));
		}
		$options = array('conditions' => array('Vacation.' . $this->Vacation->primaryKey => $id));
		$this->set('vacation', $this->Vacation->find('first', $options));
	}

	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Vacation->create();
			if ($this->Vacation->save($this->request->data)) {
				$this->Session->setFlash(__('The vacation has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vacation could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$vacationTypes = $this->Vacation->VacationType->find('list');
		$users = $this->Vacation->User->find('list');
		$this->set(compact('vacationTypes', 'users'));
	}

	public function admin_edit($id = null) {
		if (!$this->Vacation->exists($id)) {
			throw new NotFoundException(__('Invalid vacation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Vacation->save($this->request->data)) {
				$this->Session->setFlash(__('The vacation has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vacation could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Vacation.' . $this->Vacation->primaryKey => $id));
			$this->request->data = $this->Vacation->find('first', $options);
		}
		$vacationTypes = $this->Vacation->VacationType->find('list');
		$users = $this->Vacation->User->find('list');
		$this->set(compact('vacationTypes', 'users'));
	}

	public function admin_delete($id = null) {
		$this->Vacation->id = $id;
		if (!$this->Vacation->exists()) {
			throw new NotFoundException(__('Invalid vacation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Vacation->delete()) {
			$this->Session->setFlash(__('The vacation has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The vacation could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
