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
class Application_Model_QuestionnaireFeedback
{
	protected $_questionnaire_feedback_id;
	protected $_questionnaire_id;
	protected $_user_id;
	protected $_station_id;
	protected $_section_id;
	protected $_starttime;

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
	 * Get Questionnaire_feedback_id value
	 *
	 * @return String Value
	*/
	public function getQuestionnaire_feedback_id()
	{
		return $this->_questionnaire_feedback_id;
	}

	/*
	 * Set Questionnaire_feedback_id value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setQuestionnaire_feedback_id($value)
	{
		$this->_questionnaire_feedback_id = $value ;
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
	 * Get Starttime value
	 *
	 * @return String Value
	*/
	public function getStarttime()
	{
		return $this->_starttime;
	}

	/*
	 * Set Starttime value
	 *
	 * @param String Value
	 * @return null
	*/
	public function setStarttime($value)
	{
		$this->_starttime = $value ;
	}


    /**
     * Return object as array
     *
     * @return array
     */
    public function toArray()
    {
        $data = array();
		$data['questionnaire_feedback_id'] = $this->getQuestionnaire_feedback_id();
		$data['questionnaire_id'] = $this->getQuestionnaire_id();
		$data['user_id'] = $this->getUser_id();
		$data['station_id'] = $this->getStation_id();
		$data['section_id'] = $this->getSection_id();
		$data['starttime'] = $this->getStarttime();
		return $data;
    }
}