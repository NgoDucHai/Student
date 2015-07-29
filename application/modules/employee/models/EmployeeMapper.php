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
    
    private function __setConvertObjectEmployeeFromArray(Employee_Model_Employee $employee, $data) {
        $employee->setEmployeeId($data->employeeId)
                ->setEmployeeName($data->employeeName)
                ->setDateOfBirth($data->dateOfBirth)
                ->setGender($data->gender)
                ->setFacultyId($data->facultyId)
                ->setPosition($data->position)
                ->setPhone($data->phone)
                ->setAddress($data->address)
                ->setRole($data->role)
                ->setAvatar($data->avatar);
                
       
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
        $data['facultyId'] = $employee->getFacultyId();
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

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Employee_Model_DbTable_Employee');
        }
        return $this->_dbTable;
    }
    /**
     * Find in Db Id If have Id then return information
     * @param type $id
     * @return boolean|\Employee_Model_Employee
     */

    public function findId($id) {
        $table = $this->getDbTable(); /* @var $table Employee_Model_DbTable_Employee */
        $result = $table->find($id); /* @var $result Zend_Db_Table_Rowset */
//        var_dump(count($result));
//        die;
        if (!count($result)) {
            return false;
        }
        $data = $result->current();
        
        $employee = new Employee_Model_Employee(); 
        $this->__setConvertObjectEmployeeFromArray($employee,$data);
        return $employee;
         
    }
    /**
     * Save information into DB
     * @param Employee_Model_Employee $employee
     * @return boolean
     */

    public function saveProfile(Employee_Model_Employee $employee) {
        $table = $this->getDbTable(); /* @var $table Employee_Model_DbTable_Employee */
        $data = $this->__getArrayFromObjectEmployee($employee);
        if (NULL === ($id = $employee->getEmployeeId())) {
            
        } else {
            $rows = $table->update($data, ['employeeId = ?' => $id]);
            $result = ($rows > 0) ? TRUE : FALSE;
            return $result;
        }
    }

}
