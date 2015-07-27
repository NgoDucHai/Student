<?php
class Teacher_Model_TeacherMapper {

    protected $_dbTable;

    /**
     * lay du lieu tu mang 1 chieu va gan cho object
     * @param Teacher_Model_Teacher $teacher
     * @param array $data
     */
    private function __setObjectTeacherFromArray(Teacher_Model_Teacher $teacher, $data) {
        $teacher->setTeacherId($data->teacherId)
                ->setTeacherName($data->teacherName)
                ->setDateOfBirth($data->dateOfBirth)
                ->setGender($data->gender)
                ->setDiploma($data->diploma)
                ->setPhone($data->phone)
                ->setAddress($data->address)
                ->setRule($data->rule);
    }

    /**
     * lay du lieu tu object tra ve mot mang
     * @param Teacher_Model_Teacher $teacher
     * @return array $data
     */
    private function __getDataFormObjectTeacher(Teacher_Model_Teacher $teacher) {
        $data['teacherId'] = $teacher->getTeacherId();
        $data['teacherName'] = $teacher->getTeacherName();
        $data['dateOfBirth'] = $teacher->getDateOfBirth();
        $data['gender'] = $teacher->getGender();
        $data['diploma'] = $teacher->getDiploma();
        $data['phone'] = $teacher->getPhone();
        $data['address'] = $teacher->getAddress();
        $data['rule'] = $teacher->getRule();
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
            $this->setDbTable('Teacher_Model_DbTable_Teacher');
        }
        return $this->_dbTable;
    }
    
    
    /**
     * 
     * @param number $id
     * @return \Teacher_Model_Teacher|boolean
     */
    public function findId($id) {
        $table = $this->getDbTable(); /* @var $table Teacher_Model_DbTable_Teacher */
        $result = $table->find($id); /* @var $result Zend_Db_Table_Rowset */
        if (count($result) == 0) {
            return false;
        }
        $data = $result->current();
        $teacher = new Teacher_Model_Teacher();
        $this->__setObjectTeacherFromArray($teacher, $data);
        return $teacher;
    }

    public function save(Teacher_Model_Teacher $teacher) {
        $table = $this->getDbTable(); /* @var $table Teacher_Model_DbTable_Teacher */
        $data = $this->__getDataFormObjectTeacher($teacher);
        if (NULL === ($id = $teacher->getTeacherId())) {
            
        } else {
            $table->update($data, ['teacherId = ?' => $id]);
        }
    }
}
