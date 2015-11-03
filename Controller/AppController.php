<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link		  http://cakephp.org CakePHP(tm) Project
 * @package	   app.Controller
 * @since		 CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
		'Session',
		'Auth',
		'Paginator',
		'DebugKit.Toolbar',
	);

	public $helpers = array(
		'Form' => array('className' => 'Bs3Helpers.Bs3Form'),
		'Html' => array('className' => 'Bs3Helpers.Bs3Html'),
		'AuthHelper.Auth',
	);

	public function beforeFilter() {
		/**
		 * AUTHENTICATE
		 */
		$this->Auth->authenticate = array(
			'LdapAuth.Ldap' => Configure::read('ldap'),
			'Form' => array( 'passwordHasher' => 'Blowfish' )
		);
		$this->Auth->loginAction = array(
			'controller' => 'users',
			'action' => 'login',
			'plugin' => false,
			'admin' => false
		);
		$this->Auth->loginRedirect = array(
			'controller' => 'vacations',
			'action' => 'index',
			'admin' => false
		);
		$this->Auth->logoutRedirect = array(
			'controller' => 'vacations',
			'action' => 'index',
			'plugin' => false,
			'admin' => false
		);

		/**
		 * AUTHORIZATION
		 */
		$this->Auth->allow('display', 'get');

		// https://github.com/dereuromark/cakephp-tools/wiki/Tiny-Auth-Role-setup
		// but we use it as only `act_role` is active!
		$authorize_config = array(
			'aclKey'   => 'act_role',
			'aclModel' => 'available_roles',
		);
		// need to configure available_roles manually
		// as default detection switches to multiple roles mode as a side effect
		Configure::load('tiny_authorize');

		$this->Auth->authorize = array('Tools.Tiny' => $authorize_config);

		/**
		 * LAYOUT
		 */
		$this->layout = 'vacations';
	}

		public function beforeRender() {
		// UGLY HACK
		// pass the initialized Auth component into our helper so we are able
		// to reach Auth->isAuthorized()
		$this->helpers['AuthHelper.Auth']['Auth'] = $this->Auth;
	}

	protected function remember_referer_as_index_page() {
		$referer = $this->request->referer($local=true);
		$this->Session->write('remembered_index_page', $referer);
	}
	protected function recall_index_page() {
		if ($this->Session->check('remembered_index_page')) {
			return $this->Session->read('remembered_index_page');
		} else {
			return array('action'=>'index');
		}
	}

}
