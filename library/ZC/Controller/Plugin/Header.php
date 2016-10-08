<?php
/**
  * Header class
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
  * ZC_Controller_Plugin_Header class
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
class ZC_Controller_Plugin_Header extends Zend_Controller_Plugin_Abstract
{
	/**
	 * Page predispatch
	 *
	 * On page pre dispatch verify the user acces, if no access
	 * rewrite the controller and action
	 *
	 * @return null
	 */
    public function dispatchLoopShutdown()
    {
        $response = $this->getResponse();

        /**
         * When no Content-Type has been set, set the default text/html; charset=utf-8
         */
        $response->setHeader('Content-Type', 'text/html; charset=utf-8');
    }
}