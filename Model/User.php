<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	public $order = 'User.sn';
	
	public $virtualFields = array(
		'fullname' => "CONCAT(User.sn, ' ', User.givenname)",
	);
	public $displayField = 'fullname';
	
	public $hasAndBelongsToMany = array(
		'Role' => array(
			'className' => 'Role',
			'joinTable' => 'roles_users',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'role_id',
			'unique' => true,
			'order' => array('Role.id ASC'),
		)
	);
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
		}
		return true;
	}

	/*
	 * 'roles'    ... add array of assigned roles
	 * 'act_role' ... add active role
	 */
	public function afterFind($results, $primary = false) {
		foreach ($results as $key => $val) {
			if (isset($val['Role'][0]['id'])) {
				$results[$key]['User']['roles'] = Hash::extract($val['Role'], '{n}.id');
				// set the last role as active one
				$results[$key]['User']['act_role'] = end($results[$key]['User']['roles']);
			} else {
				// default role: User
				$results[$key]['User']['roles'] = array(2);
				$results[$key]['User']['act_role'] = 2;
			}
		}
		return $results;
	}

	public function hasRole($user_id, $role_id) {
		// query the join table directly
		$params = array(
			'conditions' => compact('user_id', 'role_id')
		);
		// investigate why when User is accessed through ClassRegistry::init('User')
		// the __get method fill not fire and thus not return RolesUser
		//return $this->RolesUser->find('count', $params);
		// workaround for now: call the magic __get method directly
		$this->__get('RolesUser');
		// ha, php __get does not work in chained context!
		// so we ping it first to init it
		// and then:
		return $this->RolesUser->find('count', $params);
	}
}
