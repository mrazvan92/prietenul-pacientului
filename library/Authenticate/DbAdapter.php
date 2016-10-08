<?php
/**
  * Authentificate class
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
  * Authenticate_DbAdapter class
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
class Authenticate_DbAdapter implements Zend_Auth_Adapter_Interface
{
	/**
	 * @var string
	 */
	protected $_userType;
	/**
	 * @var string
	 */
	protected $_userName;
	/**
	 * @var string
	 */
	protected $_userSureName;
	/**
	 * @var string
	 */
	protected $_email;
	/**
	 * @var string
	 */
	protected $_usertz;
	/**
	 * @var string
	 */
	protected $_pass;

	/**
	 * Sets user and pass
	 *
	 * @return null
	 */
	public function __construct($userType, $userName, $userSureName=null, $email=null, $usertz=null, $pass=null)
	{
		$this->_userType = $userType;
		$this->_userName = $userName;
		$this->_userSureName = $userSureName;
		$this->_email = $email;
		$this->_usertz = $usertz;
		$this->_pass = $pass;
	}

	/**
	 * Authetificates based on predifined array
	 *
	 * @return Object Zend_Auth_Result
	 */
	public function authenticate()
	{
        if ($this->_userType === 'user') {
            $tests = new Application_Model_TestsMapper();
            $testsArr = $tests->fetchAll('test_end_time > NOW()');
            if (count($testsArr) > 0) {
                $date = new Zend_Date();
                $helper = new Helper();
                $userModel = new Application_Model_Users(array(
                    'user_name' => $this->_userName,
                    'user_surename' => $this->_userSureName,
                    'user_email' => $this->_email,
                    'user_ip' => $helper->getIpAddress(),
                    'user_regdate' => $date->toString('YYYY-MM-dd HH:mm:ss'),
                ));

                $usersMapper = new Application_Model_UsersMapper();
                $userId = $usersMapper->insert($userModel);
            } else {
                $userId = null;
            }

            if ($userId !== null) {
                return new Zend_Auth_Result(
                    Zend_Auth_Result::SUCCESS,
                    $userId
                );
            } else {
                return new Zend_Auth_Result(
                    Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID,
                    $this->_userName
                );
            }
        } elseif ($this->_userType === 'admin') {
            $adminMapper = new Application_Model_AdminMapper();
            $admin = $adminMapper->fetchRow("username = '".mysql_real_escape_string($this->_userName)."' AND password = MD5('".mysql_real_escape_string($this->_pass)."')");
            if (is_null($admin) === true) {
                return new Zend_Auth_Result(
                    Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID,
                    $this->_userName
                );
            } else {
                return new Zend_Auth_Result(
                    Zend_Auth_Result::SUCCESS,
                    $admin->getId()
                );
            }
        }

	}
}