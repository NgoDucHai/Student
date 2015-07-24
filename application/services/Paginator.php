<?php

/**
 * @author TranVanHoang
 */
class Application_Service_Paginator {

    private $_dbMapper;

    public function __construct($dbMapper) {
        $this->__setDbMapper($dbMapper);
    }

    /**
     * @return \_dbMapper
     */
    private function __getDbMapper() {
        $dbMapper = $this->_dbMapper;
        return new $dbMapper();
    }

    /**
     * @param string $dbMapper
     */
    private function __setDbMapper($dbMapper) {
        $this->_dbMapper = $dbMapper;
    }

    /**
     * paginate
     * @param int $currentPageNumber
     * @param int $itemPerPage
     * @return Zend_Paginator
     */
    public function paginate($currentPageNumber, $itemPerPage) {

        $table = $this->_dbMapper;
        $select = $table->getDbTable()->select();

        $paginator = Zend_Paginator::factory($select);
        $paginator->setCurrentPageNumber($currentPageNumber);
        $paginator->setItemCountPerPage($itemPerPage);

        return $paginator;
    }

    /**
     * 
     * @param object $dbMapper
     * @param integer $currentPageNumber
     * @param integer $itemPerPage
     * @return Zend_Paginator
     */
    static function factory($dbMapper, $currentPageNumber, $itemPerPage) {
        $pagination = new Application_Service_Paginator($dbMapper);

        return $pagination->paginate($currentPageNumber, $itemPerPage);
    }

}
