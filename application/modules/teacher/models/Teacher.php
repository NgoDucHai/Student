<?php

class Teacher_Model_Teacher {

    protected $_teacherId;
    protected $_teacherName;
    protected $_dateOfBirth;
    protected $_gender;
    protected $_diploma;
    protected $_phone;
    protected $_address;
    protected $_rule;
    protected $_avatar;

    public function __construct(array $options = null) {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value) {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid guestbook property');
        }
        $this->$method($value);
    }

    public function __get($name) {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid guestbook property');
        }
        return $this->$method();
    }

    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
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

    public function getRule() {
        return $this->_rule;
    }
    
    public function getAvatar(){
        return $this->_avatar;
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

    public function setRule($rule) {
        $this->_rule = $rule;
        return $this;
    }
    
    public function setAvatar($avatar){
        $this->_avatar = $avatar;
        return $this;
    }

}
