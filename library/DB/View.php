<?php
/**
  * DB class
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
  * DB class
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
abstract class DB_View
{

	/**
	 * Zend_Db instance
	 * @var object
	 */
    protected $_db;
    /**
	 * Table name(actual table name)
	 * @var string
	 */
    protected $_name = null;
    /**
	 * Row class used to return fetchRow() values
	 * @var string
	 */
    protected $_rowClass = 'Zend_Db_Table_Row';
    /**
	 * Rowset class used to return fetchAll() values
	 * @var string
	 */
    protected $_rowsetClass = 'Zend_Db_Table_Rowset';

    /**
	 * Sets connection to the db
	 *
	 * @return null
	 */
    public function __construct()
    {
    	$applicationConfig = new Zend_Config_Ini(APPLICATION_INI, APPLICATION_ENV);
		$this->_db = Zend_Db::factory($applicationConfig->resources->db);
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
 	 * Gets the name used
 	 *
     * @return string Returns the name
     */
    public function getName()
    {
        return $this->_name;
    }

 	/**
 	 * Sets the rowClass to use
 	 *
     * @param  string $classname
     * @return DB_View Provides a fluent interface
     */
    public function setRowClass($classname)
    {
        $this->_rowClass = (string) $classname;

        return $this;
    }

 	/**
 	 * Gets the rowClass used
 	 *
     * @return string Returns the rowClass
     */
    public function getRowClass()
    {
        return $this->_rowClass;
    }

 	/**
     * @param  string $classname
     * @return DB_View Provides a fluent interface
     */
    public function setRowsetClass($classname)
    {
        $this->_rowsetClass = (string) $classname;

        return $this;
    }

	/**
 	 * Gets the rowsetClass used
 	 *
     * @return string Returns the rowsetClass
     */
    public function getRowsetClass()
    {
        return $this->_rowsetClass;
    }

    /**
	 * Gets the Zend_Db instance
	 * @return object Returns the Zend_Db instance
	 */
    public function getAdapter()
    {
    	return $this->_db;
    }

    /**
     * Fetches all rows.
     *
     * Honors the Zend_Db_Adapter fetch mode.
     *
     * @param string|array|Zend_Db_Table_Select $where  OPTIONAL An SQL WHERE clause
     * 													or Zend_Db_Table_Select object.
     * @param string|array                      $order  OPTIONAL An SQL ORDER clause.
     * @param int                               $count  OPTIONAL An SQL LIMIT count.
     * @param int                               $offset OPTIONAL An SQL LIMIT offset.
     * @return Zend_Db_Table_Rowset_Abstract The row results per the Zend_Db_Adapter fetch mode.
     */
    public function fetchAll($where = null, $order = null, $count = null, $offset = null)
    {
    	if (!($where instanceof Zend_Db_Select)) {
	    	$select = $this->_db->select()->from($this->_name);

	    	if ($where !== null) {
	    		$select->where($where);
	    	}

	    	if ($order !== null) {
	    		$select->order($order);
	    	}

	   		if ($count !== null || $offset !== null) {
	             $select->limit($count, $offset);
	        }

    	} else {
    		$select = $where;
    	}



        $rows = $this->_fetch($select);

    	$data  = array(
            'table'    => null,
            'data'     => $rows,
        );

		$rowsetClass = $this->_rowsetClass;
    	if (!class_exists($rowsetClass)) {
            require_once 'Zend/Loader.php';
            Zend_Loader::loadClass($rowsetClass);
        }
    	return new $rowsetClass($data);
    }

    /**
     * Fetches one row in an object of type Zend_Db_Table_Row_Abstract,
     * or returns null if no row matches the specified criteria.
     *
     * @param string|array|Zend_Db_Table_Select $where  OPTIONAL An SQL WHERE clause
     * 													or Zend_Db_Table_Select object.
     * @param string|array                      $order  OPTIONAL An SQL ORDER clause.
     * @return Zend_Db_Table_Row_Abstract|null The row results per the
     *     Zend_Db_Adapter fetch mode, or null if no row found.
     */
    public function fetchRow($where = null, $order = null)
    {
    	if (!($where instanceof Zend_Db_Select)) {
	    	$select = $this->_db->select()->from($this->_name);

	    	$select->limit(1);

	    	if ($where !== null) {
	    		$select->where($where);
	    	}

	    	if ($order !== null) {
	    		$select->order($order);
	    	}

	    	$rows = $this->_fetch($select);

	    	if (count($rows) == 0) {
	            return null;
	        }

    	} else {
    	 	$select = $where->limit(1);
    	}

        $data = array(
            'table'    => null,
            'data'     => $rows[0],
        );

		$rowClass = $this->_rowClass;
    	if (!class_exists($rowClass)) {
            require_once 'Zend/Loader.php';
            Zend_Loader::loadClass($rowClass);
        }
    	return new $rowClass($data);
    }

 	/**
     * Support method for fetching rows.
     *
     * @param  Zend_Db_Table_Select $select  query options.
     * @return array An array containing the row results in FETCH_ASSOC mode.
     */
    protected function _fetch($select)
    {
        $stmt = $this->_db->query($select);
        $data = $stmt->fetchAll(Zend_Db::FETCH_ASSOC);
        return $data;
    }
}
