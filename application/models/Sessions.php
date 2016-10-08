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
class Application_Model_Sessions
{
	protected $_sessionId;
	protected $_modified;
	protected $_lifetime;
	protected $_data;

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
	 * Get SessionId value
	 *
	 * @return String Value
	*/
	public function getSessionId()
	{
		return $this->_sessionId;
	}

	/*
	 * Set SessionId value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setSessionId($value)
	{
		$this->_sessionId = $value ;
	}

	/*
	 * Get Modified value
	 *
	 * @return String Value
	*/
	public function getModified()
	{
		return $this->_modified;
	}

	/*
	 * Set Modified value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setModified($value)
	{
		$this->_modified = $value ;
	}

	/*
	 * Get Lifetime value
	 *
	 * @return String Value
	*/
	public function getLifetime()
	{
		return $this->_lifetime;
	}

	/*
	 * Set Lifetime value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setLifetime($value)
	{
		$this->_lifetime = $value ;
	}

	/*
	 * Get Data value
	 *
	 * @return String Value
	*/
	public function getData()
	{
		return $this->_data;
	}

	/*
	 * Set Data value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setData($value)
	{
		$this->_data = $value ;
	}


    /**
     * Return object as array
     *
     * @return array
     */
    public function toArray()
    {
        $data = array();
		$data['sessionId'] = $this->getSessionId();
		$data['modified'] = $this->getModified();
		$data['lifetime'] = $this->getLifetime();
		$data['data'] = $this->getData();
		return $data;
    }
}