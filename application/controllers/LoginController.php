<?php
/**
  * Login controller
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
  * Controller class
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
class LoginController extends Zend_Controller_Action
{
	/**
	 * Initialize of class
	 *
	 * @return null
	 */
    public function init()
    {

    }

	/**
	 * Called before any action call
	 *
	 * Check if actions can be called depending on user authentification status,
	 * if not redirects the action
	 *
	 * @return null
	 */
	public function preDispatch()
    {
		if (Zend_Auth::getInstance()->hasIdentity()) {
            // If the user is logged in, we don't want to show the login form;
            // however, the logout action should still be available
            if ('logout' != $this->getRequest()->getActionName()) {
                $this->_helper->redirector('index', 'index');
            }
        } else {
            // If they aren't, they can't logout, so that action should
            // redirect to the login form
            if ('logout' == $this->getRequest()->getActionName()) {
                $this->_helper->redirector('index');
            }
        }
    }

	/**
	 * Initialize lang translation
	 *
	 * @return null
	 */
    public function indexAction()
    {
        if ($this->getRequest()->isPost()) {
			$userName = $this->getRequest()->getParam('userName');
			$userSureName = $this->getRequest()->getParam('userSureName');
			$email = $this->getRequest()->getParam('email');
			$usertz = $this->getRequest()->getParam('usertz');

            $auth = Zend_Auth::getInstance();
			$authAdapter = new Authenticate_DbAdapter('user', $userName, $userSureName, $email, $usertz);

			$result = $auth->authenticate($authAdapter);
			switch($result->getCode())
			{
				case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:

					break;
				default:
					$users = new Application_Model_UsersMapper();
                    $userId = $result->getIdentity();
					$searchCondition = "user_id = ".$users->quote($userId);
					$usersObjArr = $users->fetchAll($searchCondition);

					$userSession = new Zend_Session_Namespace('login_user');
					$userSession->data = current($usersObjArr);

					return $this->_helper->redirector('index', 'index');
					break;
			}
        }
    }

    /**
	 * Clear user identity
	 *
	 * @return null
	 */
	public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        Zend_Session::destroy();
        return $this->_helper->redirector('index');
    }
}
