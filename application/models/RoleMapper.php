<?php


/**
 * Description of RoleMapper
 *
 * @author haingo
 */
class Application_Model_RoleMapper extends Application_Model_MapperAbstract{
    public function init() {
        if ($this->getDbTable() === False) {
            $this->setDbTable('Application_Model_DbTable_Role');
        }
    }

    public function fetchAll() {
        $this->init();
        $table = $this->getDbTable(); /* @var $table Application_Model_DbTable_Role */
        $result = $table->fetchAll(); /* @var $result Zend_Db_Table_Rowset*/
        if(!count($result)){
            return false;
        }
        
        return $result;
    }
}
