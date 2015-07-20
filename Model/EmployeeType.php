<?php
App::uses('AppModel', 'Model');

class EmployeeType extends AppModel {
	public $displayField = 'title';

	public $order = array('EmployeeType.ord'=>'asc');

}
