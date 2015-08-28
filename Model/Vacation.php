<?php
App::uses('AppModel', 'Model');

class Vacation extends AppModel {
	public $displayField = 'title';

	public $dateFields  = array('start', 'end');
	public $virtualFields = array(
		'start_cz' => "DATE_FORMAT(`Vacation`.`start`, '%e.%c.%Y')",
		'end_cz' => "DATE_FORMAT(`Vacation`.`end`, '%e.%c.%Y')",
	);
	
	public $validate = array(
		'start' => array(
			'rule' => 'notEmpty',
			'message' => 'Please fill the start field',
		),
		'end' => array(
			'rule' => 'notEmpty',
			'message' => 'Please fill the end field',
		),
	);

	public function beforeSave($options = array()) {
		parent::beforeSave();
		if (empty($this->data[$this->alias]['title'])) {
			$types = $this->VacationType->find('list');
			$this->data[$this->alias]['title'] = $types[$this->data[$this->alias]['vacation_type_id']];
		}
		return true;
	}

	public $belongsTo = array(
		'VacationType' => array(
			'className' => 'VacationType',
			'foreignKey' => 'vacation_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
