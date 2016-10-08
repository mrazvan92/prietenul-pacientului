<?php
/**
  * Bootstrap
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
  * Bootstrap class
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
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    /**
     * Set constants
     *
     * @param array $constants the constant
     *
     * @return nothing
     */
    protected function setconstants($constants)
    {
        foreach ($constants as $key => $value) {
            if (defined($key) === false) {
                define($key, $value);
            }
        }

    }//end setconstants()

	/**
	 * Initialize the viewer
	 *
	 * Sets and return the viewer
	 *
	 * @return Object Zend_View
	 */
	protected function _initView()
    {
        // Initialize view
        $view = new Zend_View();
        $view->doctype('XHTML1_STRICT');

        // Add it to the ViewRenderer
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
            'ViewRenderer'
        );
        $viewRenderer->setView($view);

        // Return it, so that it can be stored by the bootstrap
        return $view;
    }


    /**
     * _initConfig
     *
     * @return nothing
     */
    protected function _initConfig()
    {
        // Get params from application.ini.
        $config = new Zend_Config_Ini(
            realpath(dirname(__FILE__).'/../application').'/configs/application.ini',
            APPLICATION_ENV
        );

        // Set database configuration parameters.
        $adapter = $config->resources->db->adapter;
        $params  = $config->resources->db->params;

        // Recreate the db login info.
        $configArray = array(
                        'database' => array(
                                       'adapter' => $adapter,
                                       'params'  => array(
                                                     'host'     => $params->host,
                                                     'username' => $params->username,
                                                     'password' => $params->password,
                                                     'dbname'   => $params->dbname,
                                                    ),
                                      ),
                       );

        $config2 = new Zend_Config($configArray);

        $daba = Zend_Db::factory($config2->database);
        $daba->getConnection();

        Zend_Db_Table::setDefaultAdapter($daba);

    }//end _initConfig()


    /**
     * _initSessionAfterDb
     *
     * @return nothing
     */
    protected function _initSessionAfterDb()
    {
        $this->bootstrap('db');
        $this->bootstrap('session');

    }//end _initSessionAfterDb()


    /**
     * _initRequest
     *
     * @return nothing
     */
    protected function _initRequest()
    {
        $config = array(
                   'name'           => 'sessions',
                   'primary'        => 'sessionId',
                   'modifiedColumn' => 'modified',
                   'dataColumn'     => 'data',
                   'lifetimeColumn' => 'lifetime',
                  );

        $saveHandler = new Zend_Session_SaveHandler_DbTable($config);
        $saveHandler->setLifetime(SESSION_TIMEOUT, true);

        Zend_Session::setSaveHandler($saveHandler);
        Zend_Session::start();
        Zend_Session::namespaceIsset('default');
        header("Strict-Transport-Security: max-age=63072000");
        header("X-Frame-Options: DENY");

    }//end _initRequest()
}