<?php

class Student_Model_StudentMapper {

    protected $_dbTable;

    /**
     * lay du lieu tu mang 1 chieu va gan cho object
     * @param Student_Model_Student $student
     * @param array $data
     */
    private function __setObjectStudentFromArray(Student_Model_Student $student, $data) {
        $student->setStudentId($data->studentId)
                ->setStudentName($data->studentName)
                ->setDateOfBirth($data->dateOfBirth)
                ->setGender($data->gender)
                ->setPhone($data->phone)
                ->setAddress($data->address);
    }

    /**
     * lay du lieu tu object tra ve mot mang
     * @param Student_Model_Student $student
     * @return array $data
     */
    private function __getDataFormObjectStudent(Student_Model_Student $student) {
        $data['studentId'] = $student->getStudentId();
        $data['studentName'] = $student->getStudentName();
        $data['dateOfBirth'] = $student->getDateOfBirth();
        $data['gender'] = $student->getGender();
        $data['phone'] = $student->getPhone();
        $data['address'] = $student->getAddress();
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
            $this->setDbTable('Student_Model_DbTable_Student');
        }
        return $this->_dbTable;
    }

    /**
     * 
     * @param number $id
     * @return \Student_Model_Student|boolean
     */
    public function findId($id) {
        $table = $this->getDbTable(); /* @var $table Student_Model_DbTable_Student */
        $result = $table->find($id); /* @var $result Zend_Db_Table_Rowset */
        if (count($result) == 0) {
            return false;
        }
        $data = $result->current();
        $student = new Student_Model_Student();
        $this->__setObjectStudentFromArray($student, $data);
        return $student;
    }

    public function save(Student_Model_Student $student) {
        $table = $this->getDbTable(); /* @var $table Student_Model_DbTable_Student */
        $data = $this->__getDataFormObjectStudent($student);
        
        if (NULL === ($id = $student->getStudentId())) {
            
        } else {
            $table->update($data, ['studentId = ?' => $id]);
        }
    }

}
