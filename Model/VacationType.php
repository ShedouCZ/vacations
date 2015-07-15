<?php
App::uses('AppModel', 'Model');

class VacationType extends AppModel {
	public $displayField = 'title';

	public $order = array('VacationType.ord'=>'asc');

}
