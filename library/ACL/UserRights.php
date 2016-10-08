<?php
/**
  * ACL class
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
  * ACL_UserRights class
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
class ACL_UserRights
{
    /**
	 * Retrieve rights
	 *
	 * Sets the user rigths and after returns the acl object
	 *
	 * @return Object Zend_Acl
	 */
    public static function getRights()
    {
    	$aclObj = new Zend_Acl();

		$aclObj->add(new Zend_Acl_Resource('adminlogin'));
		$aclObj->add(new Zend_Acl_Resource('login'));
		$aclObj->add(new Zend_Acl_Resource('index'));
		$aclObj->add(new Zend_Acl_Resource('error'));
		$aclObj->add(new Zend_Acl_Resource('feedback'));

		/* guest = users not logged on */
		$aclObj->addRole(new Zend_Acl_Role('guest'));
		$aclObj->addRole(new Zend_Acl_Role('admin'));
		$aclObj->addRole(new Zend_Acl_Role('user'));

        /* guests have the rights to the login controller,
		 * the index and error controller */
        $aclObj->allow('admin');
        $aclObj->allow('guest', 'adminlogin');
        $aclObj->allow('guest', 'login');
        $aclObj->allow('guest', 'feedback');
        $aclObj->allow('guest', 'login');
        $aclObj->allow('guest', 'index');
        $aclObj->allow('guest', 'error');

		return $aclObj;
    }
}