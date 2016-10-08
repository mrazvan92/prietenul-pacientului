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
class Application_Model_Hospital
{
	protected $_hospital_id;
	protected $_county_id;
	protected $_hospital;
	protected $_address;

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
	 * Get Hospital_id value
	 *
	 * @return String Value
	*/
	public function getHospital_id()
	{
		return $this->_hospital_id;
	}

	/*
	 * Set Hospital_id value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setHospital_id($value)
	{
		$this->_hospital_id = $value ;
	}

	/*
	 * Get County_id value
	 *
	 * @return String Value
	*/
	public function getCounty_id()
	{
		return $this->_county_id;
	}

	/*
	 * Set County_id value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setCounty_id($value)
	{
		$this->_county_id = $value ;
	}

	/*
	 * Get Hospital value
	 *
	 * @return String Value
	*/
	public function getHospital()
	{
		return $this->_hospital;
	}

	/*
	 * Set Hospital value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setHospital($value)
	{
		$this->_hospital = $value ;
	}

	/*
	 * Get Address value
	 *
	 * @return String Value
	*/
	public function getAddress()
	{
		return $this->_address;
	}

	/*
	 * Set Address value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setAddress($value)
	{
		$this->_address = $value ;
	}


    /**
     * Return object as array
     *
     * @return array
     */
    public function toArray()
    {
        $data = array();
		$data['hospital_id'] = $this->getHospital_id();
		$data['county_id'] = $this->getCounty_id();
		$data['hospital'] = $this->getHospital();
		$data['address'] = $this->getAddress();
		return $data;
    }
}