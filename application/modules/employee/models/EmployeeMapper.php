<?php

class Employee_Model_EmployeeMapper extends Application_Model_MapperAbstract {


    public function __construct() {
        if ($this->getDbTable() === False) {
            $this->setDbTable('Employee_Model_DbTable_Employee');
        }
    }

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
        $this->__setConvertObjectEmployeeFromArray($employee, $data);
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

    /**
     * @author Ngo Anh Long <ngoanhlong@gmail.com>
     * @param int/string $id
     * @return boolean "if id is not found"
     * @return Zend_Db_Table_Rowset_Abstract "If id is found" 
     */
    public function findById($id) {
        $rowGettedById = $this->getDbTable()->find($id);
        $foundId = count($rowGettedById);
        if (!$foundId) {
            return FALSE;
        }
        return $rowGettedById;
    }

    /**
     * 
     * @param int/string $id
     * @return int number of rows are deleted
     */
    public function deleteById($id) {
        $dbTable = $this->getDbTable();
        $deleteOk = $dbTable->delete(['employeeId = ?' => $id]);
        return $deleteOk;
    }

    /**
     * 
     * @param int/string $id
     * @return string avatar's link is stored in db
     */
    public function getAvatarById($id) {
        $rowResult = $this->getDbTable()->fetchRow(['employeeId = ?' => $id]);
        return $rowResult->avatar;
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
