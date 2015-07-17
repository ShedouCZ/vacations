<?php
App::uses('AppModel', 'Model');

class Vacation extends AppModel {
	public $displayField = 'title';

	public $dateFields  = array('start', 'end');

	public $virtualFields = array(
		'start' => "DATE_FORMAT(`Vacation`.`start`, '%e.%c.%Y')",
		'end' => "DATE_FORMAT(`Vacation`.`end`, '%e.%c.%Y')",
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
