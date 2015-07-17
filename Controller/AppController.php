<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
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
        //'DebugKit.Toolbar',
    );

    public $helpers = array(
        'Form' => array('className' => 'Bs3Helpers.Bs3Form'),
        'Html' => array('className' => 'Bs3Helpers.Bs3Html'),
        'AuthHelper.Auth',
    );

    public function beforeFilter() {
        /**
         * AUTHORIZATION
         */
        $this->Auth->authenticate = array(
            'LdapAuth.Ldap' => Configure::read('ldap'),
            /*'Form' => array(
                'passwordHasher' => 'Blowfish'
            )*/
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
            'admin' => true
        );
        $this->Auth->logoutRedirect = array(
            'controller' => 'users',
            'action' => 'login',
            'plugin' => false,
            'admin' => false
        );

        $this->Auth->allow('index', 'view', 'display', 'get');

        /**
         * LAYOUT
         */
        if (
            $this->request->url == 'login' ||
            in_array($this->params['prefix'], array('admin'))
        ) {
            $this->layout = 'vacations';
            Configure::write('Routing.admin', true);
        } else {
            $this->layout = 'vacations';
        }
    }

        public function beforeRender() {
        // UGLY HACK
        // pass the initialized Auth component into our helper so we are able
        // to reach Auth->isAuthorized()
        $this->helpers['AuthHelper.Auth']['Auth'] = $this->Auth;
    }
}
