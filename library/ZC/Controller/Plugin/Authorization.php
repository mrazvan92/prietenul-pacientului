<?php
/**
  * Authorization class
  *
  * PHP version 5
  *
  * @category   PrietenulPacientului
  * @package    Default
  * @subpackage Index
  * @author     Sauciuc Dragos George <sauciucdragos@gmail.com>
  * @copyright  2011 GovItHub (http://www.govithub.ro)
  * @license    http://www.GovITHub.ro/prietenulpacientului/license Prietenul Pacientului License 1.0
  * @version    SVN: $Id$
  * @link       http://www.GovITHub.ro/prietenulpacientului
  * @since      File available since Release 1.0.1
 */

/**
  * ZC_Controller_Plugin_Authorization class
  *
  * @category   PrietenulPacientului
  * @package    Default
  * @subpackage Index
  * @author     Sauciuc Dragos George <sauciucdragos@gmail.com>
  * @copyright  2011 GovItHub (http://www.govithub.ro)
  * @license    http://www.GovITHub.ro/prietenulpacientului/license Prietenul Pacientului License 1.0
  * @version    Release: @package_version@
  * @link       http://www.GovITHub.ro/prietenulpacientului
  * @since      File available since Release 1.0.1
 */
class ZC_Controller_Plugin_Authorization extends Zend_Controller_Plugin_Abstract
{
	/**
	 * @var Object Zend_Auth
	 */
	private $_auth;

	/**
	 * @var Object ACL_UserRights
	 */
	private $_acl;

	/**
	 * @var Array
	 */
	private $_noauth = array('module' 	  => 'default',
							 'controller' => 'index',
							 'action' 	  => 'index'
					   );

	/**
	 * @var Array
	 */
	private $_noacl = array('module' 	 => 'default',
							'controller' => 'error',
							'action' 	 => 'error'
					  );

	/**
	 * Page predispatch
	 *
	 * On page pre dispatch verify the user acces, if no access
	 * rewrite the controller and action
	 *
	 * @return null
	 */
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$this->_auth = Zend_Auth::getInstance();
		$this->_acl = ACL_UserRights::getRights();

		if ($this->_auth->hasIdentity()) {
			$userSession = new Zend_Session_Namespace('login_user');
			$dataSession = $userSession->getIterator()->offsetGet('data');
            if ($dataSession instanceof Application_Model_Users) {
                $userRole = "user";
            } else {
                $userRole = "admin";
            }
		} else {
			$userRole = 'guest';
		}

		$controller = $request->getControllerName();
		$action = $request->getActionName();
		$module = $request->getModuleName();
		$resource = $controller;

		if (!$this->_acl->has($resource)) {
			$resource = null;
		}

		$zcfDispatcher = Zend_Controller_Front::getInstance()->getDispatcher();
		$formatedActionName = $zcfDispatcher->formatActionName($action);

		/* checks if the user has the rights to acces the page
		 * and the page requested is a valid controller */
		if ((!$this->_acl->isAllowed($userRole, $resource, $formatedActionName))
								&& ($zcfDispatcher->isDispatchable($request))) {
			if (!$this->_auth->hasIdentity()) {
				$module = $this->_noauth['module'];
				$controller = $this->_noauth['controller'];
				$action = $this->_noauth['action'];
			} else {
		    	$module = $this->_noacl['module'];
				$controller = $this->_noacl['controller'];
				$action = $this->_noacl['action'];
			}
		}

		$request->setModuleName($module);
		$request->setControllerName($controller);
		$request->setActionName($action);

	}
}