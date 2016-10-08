<?php
/**
  * UserRights Library Test
  *
  * PHP version 5
  *
  * @category  PrietenulPacientului
  * @package    Test
  * @subpackage Library
  * @author     Solomon Razvan <razvan_solomon@intelmed.ro>
  * @copyright  2011 GovItHub (http://www.govithub.ro)
  * @license    http://www.GovITHub.ro/prietenulpacientului/license Prietenul Pacientului License 1.0
  * @version    SVN: $Id$
  * @link       http://www.GovITHub.ro/prietenulpacientului
  * @since      File available since Release 1.0.1
 */

/**
  * Library Test Case
  *
  * @category  PrietenulPacientului
  * @package    Test
  * @subpackage Library
  * @author     Solomon Razvan <razvan_solomon@intelmed.ro>
  * @copyright  2011 GovItHub (http://www.govithub.ro)
  * @license    http://www.GovITHub.ro/prietenulpacientului/license Prietenul Pacientului License 1.0
  * @version    SVN: $Id$
  * @link       http://www.GovITHub.ro/prietenulpacientului
  * @since      File available since Release 1.0.1
 */
class UserRightsTest extends ControllerTestCase
{
	/**
	 * Verify resources exists
	 *
	 * @return null
	 */
    public function testResourcesExists()
    {
    	$acl = ACL_UserRights::getRights();
    	$this->assertEquals(true, $acl->has('patient'));
    	$this->assertEquals(true, $acl->has('resources'));
    	$this->assertEquals(true, $acl->has('login'));
    	$this->assertEquals(true, $acl->has('index'));
    	$this->assertEquals(true, $acl->has('error'));
    	$this->assertEquals(true, $acl->has('message'));
    	$this->assertEquals(true, $acl->has('laboratory'));
    	$this->assertEquals(true, $acl->has('preferences'));
    }
    
	/**
	 * Verify roles exists
	 *
	 * @return null
	 */
    public function testRolesExists()
    {
    	$acl = ACL_UserRights::getRights();
    	$this->assertEquals(true, $acl->hasRole('guest'));
    	$this->assertEquals(true, $acl->hasRole('office'));
    	$this->assertEquals(true, $acl->hasRole('laboratory'));
    	$this->assertEquals(true, $acl->hasRole('obgyn'));
    	$this->assertEquals(true, $acl->hasRole('admin'));
    }
    
	/**
	 * Verify acces rights
	 *
	 * @return null
	 */
    public function testAccesRights()
    {
    	$acl = ACL_UserRights::getRights();
    	$this->assertEquals(true, $acl->isAllowed('guest', 'login'));
    	$this->assertEquals(true, $acl->isAllowed('guest', 'index'));
    	$this->assertEquals(true, $acl->isAllowed('guest', 'error'));
    	
    	$this->assertEquals(true, $acl->isAllowed('office', 'patient'));
    	$this->assertEquals(true, $acl->isAllowed('office', 'resources'));
    	$this->assertEquals(true, $acl->isAllowed('office', 'message'));
    	$this->assertEquals(true, $acl->isAllowed('office', 'preferences'));
    	
    	$this->assertEquals(true, $acl->isAllowed('laboratory', 'laboratory'));
    	$this->assertEquals(false, $acl->isAllowed('laboratory', 'patient', 'getPatientsAction'));
    	
    	$this->assertEquals(true, $acl->isAllowed('admin'));
    }
}