<?php

/**
 * position mapper
 * @author TranVanHoang <hoangtv@vnext.com.vn>
 */
class Application_Model_PositionMapper extends Application_Model_MapperAbstract {
    
    /**
     * set db table
     */
    private function __init() {
        if ($this->getDbTable() === False) {
            $this->setDbTable('Application_Model_DbTable_Position');
        }
    }
    
    /**
     * get all list employee's position
     * @return boolean
     */
    public function fetchAll() {
        $this->__init();
        $table = $this->getDbTable(); /* @var $table Application_Model_DbTable_Faculty */
        $result = $table->fetchAll(); /* @var $result Zend_Db_Table_Rowset */
        if (!count($result)) {
            return false;
        }

        return $result;
    }

}
