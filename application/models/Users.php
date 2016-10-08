<?php
/**
  * Table model
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
  * Table model class
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
class Application_Model_Users
{
	protected $_user_id;
	protected $_auth_code;
	protected $_ip;
	protected $_timestamp;

	/**
	 * Model class constructor
	 *
	 * @param array $options, to set model properties
	 */
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * Magic method to set properties
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid property');
        }
        $this->$method($value);
    }

    /**
     * Magic method to get property values
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid property');
        }
        return $this->$method();
    }

    /**
     * Set Model properties
     *
     * @param array $options
     * @return this Model instance
     */
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

   	/*
	 * Get User_id value
	 *
	 * @return String Value
	*/
	public function getUser_id()
	{
		return $this->_user_id;
	}

	/*
	 * Set User_id value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setUser_id($value)
	{
		$this->_user_id = $value ;
	}

	/*
	 * Get Auth_code value
	 *
	 * @return String Value
	*/
	public function getAuth_code()
	{
		return $this->_auth_code;
	}

	/*
	 * Set Auth_code value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setAuth_code($value)
	{
		$this->_auth_code = $value ;
	}

	/*
	 * Get Ip value
	 *
	 * @return String Value
	*/
	public function getIp()
	{
		return $this->_ip;
	}

	/*
	 * Set Ip value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setIp($value)
	{
		$this->_ip = $value ;
	}

	/*
	 * Get Timestamp value
	 *
	 * @return String Value
	*/
	public function getTimestamp()
	{
		return $this->_timestamp;
	}

	/*
	 * Set Timestamp value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setTimestamp($value)
	{
		$this->_timestamp = $value ;
	}


    /**
     * Return object as array
     *
     * @return array
     */
    public function toArray()
    {
        $data = array();
		$data['user_id'] = $this->getUser_id();
		$data['auth_code'] = $this->getAuth_code();
		$data['ip'] = $this->getIp();
		$data['timestamp'] = $this->getTimestamp();
		return $data;
    }
}