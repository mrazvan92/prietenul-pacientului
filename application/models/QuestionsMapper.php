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
class Application_Model_QuestionsMapper
{
    /**
     * Zend db table object
     *
     * @var Zend_Db_Table_Abstract
     */
	protected $_dbTable;

	/**
	 * Set db table object
	 *
	 * @param string $dbTable
	 * @return this mapper class instance
	 */
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    /**
     * Return instance of Zend_Db_Table_Abstract set for this mapper
     *
     * @return Application_Model_DbTable_Questions
     */
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Questions');
        }
        return $this->_dbTable;
    }

    /**
     * Save data from model, when id is set, it will try and update
     *
     * @param Application_Model_Questions instance
     * @return void
     */
    public function save(Application_Model_Questions $model)
    {
        $data = array(
			'question_id' => $model->getQuestion_id(),
			'section_id' => $model->getSection_id(),
			'question' => $model->getQuestion(),
			'description' => $model->getDescription(),
			'question_type' => $model->getQuestion_type()
		);


        if (null === ($id = $model->getId())) {
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    /**
     * Insert data from model
     *
     * @param Application_Model_Questions instance
     * @return void
     */
    public function insert(Application_Model_Questions $model)
    {
    	$data = array(
			'question_id' => $model->getQuestion_id(),
			'section_id' => $model->getSection_id(),
			'question' => $model->getQuestion(),
			'description' => $model->getDescription(),
			'question_type' => $model->getQuestion_type()
		);

    	return $this->getDbTable()->insert($data);
    }

    /**
     * Update data from model
     *
     * @param Application_Model_Questions instance
     * @param string $where
     * @return void
     * @todo uset primary key!?
     */
    public function update(Application_Model_Questions $model, $where)
    {
    	$data = array(
			'question_id' => $model->getQuestion_id(),
			'section_id' => $model->getSection_id(),
			'question' => $model->getQuestion(),
			'description' => $model->getDescription(),
			'question_type' => $model->getQuestion_type()
		);

    	return $this->getDbTable()->update($data, $where);
    }

    /**
     * Map data to model
     *
     * @param Zend_Db_Table_Row row
     * @param Application_Model_Questions $model
     * @return void
     */
    public function map($row, Application_Model_Questions $model)
    {
		$model->setQuestion_id($row->question_id);
		$model->setSection_id($row->section_id);
		$model->setQuestion($row->question);
		$model->setDescription($row->description);
		$model->setQuestion_type($row->question_type);

    }

    /**
     * Find a record of Model, when found model is set
     *
     * @param $id
     * @return Application_Model_Questions
     */
    public function find($id)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $model = new Application_Model_Questions();
        $this->map($result->current(), $model);
        return $model;
    }

    /**
     * Fetch all records from Model used
     *
     * @return array of Application_Model_Questions
     */
    public function fetchAll($where = null, $order = null, $count = null, $offset = null)
    {
        $resultSet = $this->getDbTable()->fetchAll($where, $order, $count, $offset);
        $entries   = array();
        foreach ($resultSet as $row) {
            $model = new Application_Model_Questions();
			$this->map($row, $model);
            $entries[] = $model;
        }
        return $entries;
    }

    /**
     * Find a row of Model, when found model is set
     *
     * @param $where
     * @param $order
     * @return Application_Model_Questions
     */
    public function fetchRow($where = null, $order = null)
    {
    	$result = $this->getDbTable()->fetchRow($where, $order);
        if (null === $result) {
            return;
        }
        $model = new Application_Model_Questions();
        $this->map($result, $model);
        return $model;
    }

    /**
     * Delete
     *
     * @param array|string $where SQL WHERE clause(s).
     * @return int 		   The number of rows deleted.
     */
    public function delete($where)
    {
    	return $this->getDbTable()->delete($where);
    }
}
