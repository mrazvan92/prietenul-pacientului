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
class Application_Model_Questionnaire
{
	protected $_questionnaire_id;
	protected $_name;
	protected $_description;

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
	 * Get Questionnaire_id value
	 *
	 * @return String Value
	*/
	public function getQuestionnaire_id()
	{
		return $this->_questionnaire_id;
	}

	/*
	 * Set Questionnaire_id value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setQuestionnaire_id($value)
	{
		$this->_questionnaire_id = $value ;
	}

	/*
	 * Get Name value
	 *
	 * @return String Value
	*/
	public function getName()
	{
		return $this->_name;
	}

	/*
	 * Set Name value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setName($value)
	{
		$this->_name = $value ;
	}

	/*
	 * Get Description value
	 *
	 * @return String Value
	*/
	public function getDescription()
	{
		return $this->_description;
	}

	/*
	 * Set Description value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setDescription($value)
	{
		$this->_description = $value ;
	}


    /**
     * Return object as array
     *
     * @return array
     */
    public function toArray()
    {
        $data = array();
		$data['questionnaire_id'] = $this->getQuestionnaire_id();
		$data['name'] = $this->getName();
		$data['description'] = $this->getDescription();
		return $data;
    }
}