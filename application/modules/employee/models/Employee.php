<?php

class Employee_Model_Employee extends Application_Model_Abstract {

    protected $_employeeId;
    protected $_employeeName;
    protected $_dateOfBirth;
    protected $_gender;
    protected $_facultyId;
    protected $_position;
    protected $_phone;
    protected $_address;
    protected $_role;
    protected $_avatar;

//    public function __construct($option){
//        var_dump($option);die;
//    }
//    



    public function getEmployeeId() {
        return $this->_employeeId;
    }

    public function getEmployeeName() {
        return $this->_employeeName;
    }

    public function getDateOfBirth() {
        return $this->_dateOfBirth;
    }

    public function getGender() {
        return $this->_gender;
    }

    public function getFacultyId() {
        return $this->_facultyId;
    }

    public function getPosition() {
        return $this->_position;
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

    public function getAvatar() {
        return $this->_avatar;
    }

    public function setEmployeeId($employeeId) {
        $this->_employeeId = $employeeId;
        return $this;
    }

    public function setEmployeeName($employeeName) {
        $this->_employeeName = $employeeName;
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

    public function setFacultyId($facultyId) {
        $this->_facultyId = $facultyId;
        return $this;
    }

    public function setPosition($position) {
        $this->_position = $position;
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

    public function setAvatar($avatar) {
        $this->_avatar = $avatar;
        return $this;
    }

}
