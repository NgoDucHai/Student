<?php
/**
 * @author TranVanHoang
 */
class Application_Service_Paginator {

    private $_dbMapper;

    public function __construct($dbMapper) {
        $this->setDbMapper($dbMapper);
    }

    /**
     * @return \_dbMapper
     */
    private function getDbMapper() {
        $dbMapper = $this->_dbMapper;
        return new $dbMapper();
    }

    /**
     * @param string $dbMapper
     */
    private function setDbMapper($dbMapper) {
        $this->_dbMapper = $dbMapper;
    }

    /**
     * paginate
     * @param int $currentPageNumber
     * @param int $itemPerPage
     * @return Zend_Paginator
     */
    public function paginate($currentPageNumber, $itemPerPage) {
        $table = $this->getDbMapper();
        $select = $table->getDbTable()->select();
        $paginator = Zend_Paginator::factory($select);
        $paginator->setCurrentPageNumber($currentPageNumber);
        $paginator->setItemCountPerPage($itemPerPage);
        return $paginator;
    }

}
