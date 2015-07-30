<?php

class Teacher_Model_Teacher extends Application_Model_Abstract {

    protected $_teacherId;
    protected $_teacherName;
    protected $_dateOfBirth;
    protected $_gender;
    protected $_diploma;
    protected $_phone;
    protected $_address;
    protected $_role;
    protected $_avatar;
    public function getAvatar() {
        return $this->_avatar;
    }

    public function setAvatar($avatar) {
        $this->_avatar = $avatar;
    }

        public function getTeacherId() {
        return $this->_teacherId;
    }

    public function getTeacherName() {
        return $this->_teacherName;
    }

    public function getDateOfBirth() {
        return $this->_dateOfBirth;
    }

    public function getGender() {
        return $this->_gender;
    }

    public function getDiploma() {
        return $this->_diploma;
    }

    public function getPhone() {
        return $this->_phone;
    }

    public function getAddress() {
        return $this->_address;
    }

    public function getRole() {
        return $this->_role;
    }

    public function setTeacherId($teacherId) {
        $this->_teacherId = $teacherId;
        return $this;
    }

    public function setTeacherName($teacherName) {
        $this->_teacherName = $teacherName;
        return $this;
    }

    public function setDateOfBirth($dateOfBirth) {
        $this->_dateOfBirth = $dateOfBirth;
        return $this;
    }

    public function setGender($gender) {
        $this->_gender = $gender;
        return $this;
    }

    public function setDiploma($diploma) {
        $this->_diploma = $diploma;
        return $this;
    }

    public function setPhone($phone) {
        $this->_phone = $phone;
        return $this;
    }

    public function setAddress($address) {
        $this->_address = $address;
        return $this;
    }

    public function setRole($role) {
        $this->_role = $role;
        return $this;
    }

}
