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
        $data['employeeId'] = $employee->getEmployeeId();
        $data['employeeName'] = $employee->getEmployeeName();
        $data['dateOfBirth'] = $employee->getDateOfBirth();
        $data['gender'] = $employee->getGender();
        $data['faculltyId'] = $employee->getFaculltyId();
        $data['position'] = $employee->getPosition();
        $data['phone'] = $employee->getPhone();
        $data['address'] = $employee->getAddress();
        $data['role'] = $employee->getRole();
        $data['avatar'] = $employee->getAvatar();

        return $data;
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
            $this->setDbTable('Employee_Model_DbTable_Employee');
        }
        return $this->_dbTable;
    }

    /**
     * @author Ngo Anh Long <ngoanhlong@gmail.com>
     * Get all profiles 
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getAllProfiles() {
        $sql = $this->getDbTable()->select();
        $result = $this->getDbTable()->fetchAll($sql);
        return $result;
    }

    /**
     * @author Ngo Anh Long <ngoanhlong@gmail.com>
     * @param int/string $id
     * @return boolean "if id is not found"
     * @return Zend_Db_Table_Rowset_Abstract "If id is found" 
     */
    public function findById($id)
    {
        $rowGettedById = $this->getDbTable()->find($id);
        $foundId = count($rowGettedById);
        if(!$foundId)
        {
            return FALSE;
        }
        return $rowGettedById;
    }
    
    /**
     * 
     * @param int/string $id
     * @return int number of rows are deleted
     */
    public function deleteById($id)
    {
        $dbTable = $this->getDbTable();
        $deleteOk = $dbTable->delete(['employeeId = ?' => $id]);
        return $deleteOk;
    }
    
    /**
     * 
     * @param Employee_Model_Employee $employee
     */
    public function save(Employee_Model_Employee $employee) {
        $data = $this->__getArrayFromObjectEmployee($employee);
        var_dump($data);
        die;
    }

}
