<?php

class Student_Model_Student {

    protected $_id;
    protected $_studentId;
    protected $_studentName;
    protected $_dateOfBirth;
    protected $_gender;
    protected $_phone;
    protected $_address;

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

    public function getId() {
        return $this->_id;
    }

    public function getStudentId() {
        return $this->_studentId;
    }

    public function getStudentName() {
        return $this->_studentName;
    }

    public function getDateOfBirth() {
        return $this->_dateOfBirth;
    }

    public function getGender() {
        return $this->_gender;
    }

    public function getPhone() {
        return $this->_phone;
    }

    public function getAddress() {
        return $this->_address;
    }

    public function setId($id) {
        $this->_id = $id;
    }

    public function setStudentId($studentId) {
        $this->_studentId = $studentId;
        return $this;
    }

    public function setStudentName($studentName) {
        $this->_studentName = $studentName;
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

    public function setPhone($phone) {
        $this->_phone = $phone;
        return $this;
    }

    public function setAddress($address) {
        $this->_address = $address;
        return $this;
    }

}
