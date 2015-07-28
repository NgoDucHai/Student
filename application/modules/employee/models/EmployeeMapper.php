<?php

class Employee_Model_EmployeeMapper {

    protected $_dbTable;

    /**
     * lay du lieu tu mang 1 chieu va gan cho object
     * @param array $data
     * @return Employee_Model_Employee
     */
    private function __setObjectEmployeeFromArray($data) {
        return new Employee_Model_Employee($data);
    }

    /**
     * lay du lieu tu object tra ve mot mang
     * @param Employee_Model_Employee $employee
     * @return array
     */
    private function __getArrayFromObjectEmployee(Employee_Model_Employee $employee) {
        return (array) $employee;
    }

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

    /**
     * 
     * @return Zend_Db_Table
     */
    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Employee_Model_Employee');
        }
        return $this->_dbTable;
    }
    
    public function getAllEmployeeProfiles()
    {
        $dataRowSet = $this->getDbTable()->fetchAll();
        
    }

}
