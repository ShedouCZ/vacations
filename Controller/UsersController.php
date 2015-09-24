<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
	public $uses = array('User', 'EmployeeType');
	
	// declare public actions
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login', 'logout');
	}

	public $paginate = array(
		'limit' => 120
	);

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Session->setFlash(__('Invalid username or password, try again')); 
		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

	public function index() {
		$this->Paginator->settings = $this->paginate;
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(
				__('The user could not be saved. Please, try again.')
			);
		}
		
		$roles = $this->get_roles_list();
		$this->set(compact('roles'));
	}

	public function import() {
		$methods = $this->Auth->constructAuthenticate();

		foreach ($methods as $method) {
			if (get_class($method) == 'LdapAuthenticate') {
				$method->import_users();
				echo 'OK';
				exit();
			}
		}
		exit();
	}

	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(
				__('The user could not be saved. Please, try again.')
			);
		} else {
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']);
		}
		$roles = $this->get_roles_list();
		$this->set(compact('roles'));
	}
	
	public function disable($id = null) {
		$this->autoRender = false;
		$this->request->allowMethod('post');
		
		$user = $this->User->findById($id);
		
		if (empty($user)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->User->id = $id;
		if ($this->User->saveField('disabled', !$user['User']['disabled'])) {
			echo 'OK';
		} else {
			echo 'NOK';
		}
	}

	public function delete($id = null) {
		$this->request->allowMethod('post');

		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
	
	public function switch_role($role) {
		$user = $this->Auth->user();
		if (in_array($role, $user['roles'], $strict=true)) {
			$user['act_role'] = $role;
		}
		$this->Auth->login($user);
		$role = $this->User->Role->findById($this->Auth->user('act_role'));
		return $this->redirect($role['Role']['homepage']);
	}

	public function switch_user($user_id) {
		if (AuthComponent::user('act_role') == Configure::read('available_roles.administrator')) {
			$user = $this->User->findById($user_id);
			// form new user data
			$data = $user['User'] + array('Role' => $user['Role']);
			$this->Auth->login($data);
			$role = $this->User->Role->findById($this->Auth->user('act_role'));
			return $this->redirect($role['Role']['homepage']);
		}
	}
	
	private function get_roles_list() {
		$roles = $this->User->Role->find('list', array('conditions'=>array('alias !='=>array('Anonymous', 'User'))));
		$roles = array_map(function ($i) { return __($i);}, $roles);
		return $roles;
	}

}
