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
class Application_Model_Questions
{
	protected $_question_id;
	protected $_section_id;
	protected $_question;
	protected $_description;
	protected $_question_type;

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
	 * Get Question_id value
	 *
	 * @return String Value
	*/
	public function getQuestion_id()
	{
		return $this->_question_id;
	}

	/*
	 * Set Question_id value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setQuestion_id($value)
	{
		$this->_question_id = $value ;
	}

	/*
	 * Get Section_id value
	 *
	 * @return String Value
	*/
	public function getSection_id()
	{
		return $this->_section_id;
	}

	/*
	 * Set Section_id value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setSection_id($value)
	{
		$this->_section_id = $value ;
	}

	/*
	 * Get Question value
	 *
	 * @return String Value
	*/
	public function getQuestion()
	{
		return $this->_question;
	}

	/*
	 * Set Question value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setQuestion($value)
	{
		$this->_question = $value ;
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

	/*
	 * Get Question_type value
	 *
	 * @return String Value
	*/
	public function getQuestion_type()
	{
		return $this->_question_type;
	}

	/*
	 * Set Question_type value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setQuestion_type($value)
	{
		$this->_question_type = $value ;
	}


    /**
     * Return object as array
     *
     * @return array
     */
    public function toArray()
    {
        $data = array();
		$data['question_id'] = $this->getQuestion_id();
		$data['section_id'] = $this->getSection_id();
		$data['question'] = $this->getQuestion();
		$data['description'] = $this->getDescription();
		$data['question_type'] = $this->getQuestion_type();
		return $data;
    }
}