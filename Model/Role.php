<?php
App::uses('AppModel', 'Model');

class Role extends AppModel {
	public $displayField = 'alias';
	public $order = 'id';
}
