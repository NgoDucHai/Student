<?php

class Employee_Model_Employee {

    protected $_employeeId;
    protected $_employeeName;
    protected $_dateOfBirth;
    protected $_gender;
    protected $_faculltyId;
    protected $_position;
    protected $_phone;
    protected $_address;
    protected $_role;
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

    public function getFaculltyId() {
        return $this->_faculltyId;
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

    public function setFaculltyId($faculltyId) {
        $this->_faculltyId = $faculltyId;
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
