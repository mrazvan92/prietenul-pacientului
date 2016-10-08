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
class Application_Model_Doctors
{
	protected $_doctor_id;
	protected $_station_id;
	protected $_doctor_name;
	protected $_doctor_surname;

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
	 * Get Doctor_id value
	 *
	 * @return String Value
	*/
	public function getDoctor_id()
	{
		return $this->_doctor_id;
	}

	/*
	 * Set Doctor_id value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setDoctor_id($value)
	{
		$this->_doctor_id = $value ;
	}

	/*
	 * Get Station_id value
	 *
	 * @return String Value
	*/
	public function getStation_id()
	{
		return $this->_station_id;
	}

	/*
	 * Set Station_id value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setStation_id($value)
	{
		$this->_station_id = $value ;
	}

	/*
	 * Get Doctor_name value
	 *
	 * @return String Value
	*/
	public function getDoctor_name()
	{
		return $this->_doctor_name;
	}

	/*
	 * Set Doctor_name value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setDoctor_name($value)
	{
		$this->_doctor_name = $value ;
	}

	/*
	 * Get Doctor_surname value
	 *
	 * @return String Value
	*/
	public function getDoctor_surname()
	{
		return $this->_doctor_surname;
	}

	/*
	 * Set Doctor_surname value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setDoctor_surname($value)
	{
		$this->_doctor_surname = $value ;
	}


    /**
     * Return object as array
     *
     * @return array
     */
    public function toArray()
    {
        $data = array();
		$data['doctor_id'] = $this->getDoctor_id();
		$data['station_id'] = $this->getStation_id();
		$data['doctor_name'] = $this->getDoctor_name();
		$data['doctor_surname'] = $this->getDoctor_surname();
		return $data;
    }
}