<?php

/**
 * Description of FacultyMapper
 *
 * @author linux
 */
class Application_Model_FacultyMapper extends Application_Model_MapperAbstract {

    public function init() {
        if ($this->getDbTable() === False) {
            $this->setDbTable('Application_Model_DbTable_Faculty');
        }
    }

    public function fetchAll() {
        $this->init();
        $table = $this->getDbTable(); /* @var $table Application_Model_DbTable_Faculty */
        $result = $table->fetchAll(); /* @var $result Zend_Db_Table_Rowset*/
        if(!count($result)){
            return false;
        }
        
        return $result;
    }

}
