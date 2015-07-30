<?php

class Teacher_Model_TeacherMapper extends Application_Model_MapperAbstract{

    public function __construct() {
        if ($this->getDbTable() === False) {
            $this->setDbTable('Teacher_Model_DbTable_Teacher');
        }
    }

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
                ->setRole($data->role)
                ->setAvatar($data->avatar);

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
        $data['role'] = $teacher->getRole();
        $data['avatar'] = $teacher->getAvatar() ? $teacher->getAvatar() :
                realpath(APPLICATION_PATH . '/../public/images/avatar/defaultAvatar.png');

        return $data;
    }

   

    /**
     * insert teacher profile
     * @param Teacher_Model_Teacher $teacher
     */
    public function save($teacher) {
        $data = $this->__getDataFormObjectTeacher($teacher);
        if($this->getDbTable()->insert($data))
            return true;
    }
    
    /**
     * @param number $id
     * @return \Teacher_Model_Teacher|boolean
     */
    public function findId($id) {
        $table = $this->getDbTable(); /* @var $table Teacher_Model_DbTable_Teacher */
        $result = $table->find($id); /* @var $result Zend_Db_Table_Rowset */

        if (!count($result)) {
            return false;
        }
        $data = $result->current();
        $teacher = new Teacher_Model_Teacher();
        $this->__setObjectTeacherFromArray($teacher, $data);
        return $teacher;
    }

    /**
     * 
     * @param integer $id
     * @return boolean
     */
    public function deleteId($id) {
        $table = $this->getDbTable(); /* @var $table Teacher_Model_DbTable_Teacher */
        $result = $table->delete(['teacherId = ?' => $id]);

        return count($result) ? true : false;
    }

    /**
     * Save data from updata-profile Form into DB
     * @param Teacher_Model_Teacher $teacher
     */
    public function saveProfile(Teacher_Model_Teacher $teacher) {
        $table = $this->getDbTable(); /* @var $table Teacher_Model_DbTable_Teacher */
        $data = $this->__getDataFormObjectTeacher($teacher);
        if (NULL === ($id = $teacher->getTeacherId())) {
            
        } else {
            $rows = $table->update($data, ['teacherId = ?' => $id]);
            $result = ($rows > 0) ? TRUE : FALSE;
            return $result;
        }
    }

}
