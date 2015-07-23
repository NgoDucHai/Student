<?php

class Student_Model_StudentMapper {

    protected $_dbTable;

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
    
    public function find($id, Student_Model_Student $student) {
       
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return false;
        }
        $row = $result->current();
        $student->setId($row->id);
        $student->setStudentId($row->studentId);
        $student->setStudentName($row->studentName);
        $student->setDateOfBirth($row->dateOfBirth);
        $student->setGender($row->gender);
        $student->setPhone($row->phone);
        $student->setAddress($row->address);
        return TRUE;
    }

}
