<?php
App::uses('AppController', 'Controller');
class VacationTypesController extends AppController {
	public $layout = 'BootstrapCake.bootstrap';
	public $components = array('Paginator', 'Session');
	
	public function index() {
		$this->VacationType->recursive = 0;
		$this->set('vacationTypes', $this->Paginator->paginate());
	}

	public function reorder() {
		if ($this->request->is('post')) {
			$this->VacationType->saveMany($this->request->data);
			exit();
		}
		$this->set('vacationTypes', $this->VacationType->find('all'));
	}

	public function view($id = null) {
		if (!$this->VacationType->exists($id)) {
			throw new NotFoundException(__('Invalid vacation type'));
		}
		$options = array('conditions' => array('VacationType.' . $this->VacationType->primaryKey => $id));
		$this->set('vacationType', $this->VacationType->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->VacationType->create();
			if ($this->VacationType->save($this->request->data)) {
				$this->Session->setFlash(__('The vacation type has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vacation type could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
	}

	public function edit($id = null) {
		if (!$this->VacationType->exists($id)) {
			throw new NotFoundException(__('Invalid vacation type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->VacationType->save($this->request->data)) {
				$this->Session->setFlash(__('The vacation type has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vacation type could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('VacationType.' . $this->VacationType->primaryKey => $id));
			$this->request->data = $this->VacationType->find('first', $options);
		}
	}

	public function delete($id = null) {
		$this->VacationType->id = $id;
		if (!$this->VacationType->exists()) {
			throw new NotFoundException(__('Invalid vacation type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->VacationType->delete()) {
			$this->Session->setFlash(__('The vacation type has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The vacation type could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
