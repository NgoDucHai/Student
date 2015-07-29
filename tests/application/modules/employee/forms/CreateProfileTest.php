<?php

/**
 * Description of NewEmpployeeTest
 *
 * @author domanhdat
 */
class Employee_Form_CreateProfileTest extends PHPUnit_Framework_TestCase {

    protected $_form;

    protected function setUp() {
        parent::setUp();
        $application = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        $application->getBootstrap()->bootstrap();
        $this->_form = new Employee_Form_CreateProfile();

//        $_FILES = array(
//            'file' => array(
//                'name' => '1.png',
//                'type' => 'image/png',
//                'size' => 47566,
//                'tmp_name' => '/home/linux/Desktop/1.png',
//                'error' => 0
//            )
//        );
    }

    public function testIsValidWillReturnFallWhenInjectBadProfile() {
        $this->_form->removeElement('avatar');
        $this->assertTrue($this->_form->isValid(
                        [
                            'employeeId' => 123465789,
                            'employeeName' => 'domanhdat',
                            'dateOfBirth' => '01-12-1993',
                            'gender' => 1,
                            'facultyId' => 1,
                            'position' => 1,
                            'phone' => '1234567890',
                            'address' => 'hanoi',
                            'role' => 1,
                        ]
        ));
    }

}
