<?php

/**
 *
 * @author domanhdat
 */
class Application_Model_Faculty extends Application_Model_Abstract {

    protected $_facultyId;
    protected $_facultyName;

    public function getFacultyId() {
        return $this->_facultyId;
    }

    public function getFacultyName() {
        return $this->_facultyName;
    }

    public function setFacultyId($facultyId) {
        $this->_facultyId = $facultyId;
    }

    public function setFacultyName($facultyName) {
        $this->_facultyName = $facultyName;
    }

}
