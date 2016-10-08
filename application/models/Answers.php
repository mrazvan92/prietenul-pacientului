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
class Application_Model_Answers
{
	protected $_answer_id;
	protected $_question_id;
	protected $_answer;
	protected $_value;

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
	 * Get Answer_id value
	 *
	 * @return String Value
	*/
	public function getAnswer_id()
	{
		return $this->_answer_id;
	}

	/*
	 * Set Answer_id value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setAnswer_id($value)
	{
		$this->_answer_id = $value ;
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
	 * Get Answer value
	 *
	 * @return String Value
	*/
	public function getAnswer()
	{
		return $this->_answer;
	}

	/*
	 * Set Answer value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setAnswer($value)
	{
		$this->_answer = $value ;
	}

	/*
	 * Get Value value
	 *
	 * @return String Value
	*/
	public function getValue()
	{
		return $this->_value;
	}

	/*
	 * Set Value value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setValue($value)
	{
		$this->_value = $value ;
	}


    /**
     * Return object as array
     *
     * @return array
     */
    public function toArray()
    {
        $data = array();
		$data['answer_id'] = $this->getAnswer_id();
		$data['question_id'] = $this->getQuestion_id();
		$data['answer'] = $this->getAnswer();
		$data['value'] = $this->getValue();
		return $data;
    }
}