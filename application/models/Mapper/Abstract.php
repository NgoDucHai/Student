<?php

/**
 *
 * @author domanhdat
 */
class Application_Model_Mapper_Abstract {

    protected $_dbTable;

    public function setDbTable($dbTable) {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable() {
        if (null === $this->_dbTable) {
            throw new Exception('You are could not set Dbtable');
        }
        return $this->_dbTable;
    }

}
