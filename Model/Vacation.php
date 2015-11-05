<?php
App::uses('AppModel', 'Model');

class Vacation extends AppModel {
	public $displayField = 'title';

	public $dateFields  = array('start', 'end', 'end_inclusive');
	public $virtualFields = array(
		'start_cz' => "DATE_FORMAT(`Vacation`.`start`, '%e.%c.%Y')",
		'end_cz' => "DATE_FORMAT(`Vacation`.`end`, '%e.%c.%Y')",
		'end_inclusive' => "DATE_SUB(`Vacation`.`end`, INTERVAL 1 DAY)"
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
		if (empty($this->data['Vacation']['title'])) {
			$types = $this->VacationType->find('list');
			$this->data['Vacation']['title'] = $types[$this->data['Vacation']['vacation_type_id']];
		}
		if (!empty($this->data['Vacation']['end_inclusive'])) {
			// compute (exclusive) end date from the end_inclusive date
			$end_inclusive = $this->data['Vacation']['end_inclusive'];
			$this->data['Vacation']['end'] = date('Y-m-d', strtotime($end_inclusive . ' +1 days'));
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
