<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	public $order = 'User.sn';
	
	public $virtualFields = array(
		'fullname' => "CONCAT(User.sn, ' ', User.givenname)",
	);
	public $displayField = 'fullname';
	
	public function beforeFind($query) {
		// only enabled ones by default
		if (!isset($query['conditions']['User.disabled']) && !isset($query['conditions']['disabled'])) {
			$query['conditions']['User.disabled'] = 0;
		}
		return $query;
	}
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
		}
		return true;
	}
}
