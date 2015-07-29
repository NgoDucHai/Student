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
     * 
     * @param number $id
     * @return \Employee_Model_Employee|boolean
     */
    public function findId($id) {
        $table = $this->getDbTable(); /* @var $table Employee_Model_DbTable_Employee */
        $result = $table->find($id); /* @var $result Zend_Db_Table_Rowset */
        if (!count($result)) {
            return false;
        }
        $data = $result->current();
        $student = $this->__setObjectEmployeeFromArray($data);
        return $student;
    }

    public function save(Employee_Model_Employee $employee) {
        $table = $this->getDbTable(); /* @var $table Employee_Model_DbTable_Employee */
        $this->__setDefaultAvatar($employee);
        $data = $this->__getArrayFromObjectEmployee($employee);
        $result = $this->findId($employee->getEmployeeId());

        if (FALSE === $result) {
            return $table->insert($data) ? true : false;
        }
    }

    /**
     * set default avatar if avatar null
     * @param \Employee_Model_Employee $employee
     */
    private function __setDefaultAvatar(Employee_Model_Employee $employee) {
        if ($employee->getAvatar() === NULL) {
            $avatar = realpath(APPLICATION_PATH . '/../public/images/avatar/avatarDefault.png');
            $employee->setAvatar($avatar);
        }
    }

}
