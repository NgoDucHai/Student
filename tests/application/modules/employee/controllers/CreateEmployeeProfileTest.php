<?php

/**
 * @author domanhdat
 */
class CreateEmployeeProfileTest extends Zend_Test_PHPUnit_ControllerTestCase {

    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testWhenAccessPageCreateEmployeeThenReturnHttpCode200() {
        $this->dispatch('/employee/profile/create-profile');

        $this->assertResponseCode(200);
        $this->assertModule('employee');
        $this->assertController('profile');
        $this->assertAction('create-profile');
    }

    public function testWhenAccessPageCreateEmployeeThenDisplayTitle() {
        $this->dispatch('/employee/profile/create-profile');

        $this->assertQueryContentContains('head', 'Create profile employee');
    }

    public function testWhenAccessPageCreateEmployeeThenDisplayFromCreateProfile() {
        $this->dispatch('/employee/profile/create-profile');

        $this->assertQuery('form#create-profile');

        $this->assertQuery('input[@name="employeeId"]');
        $this->assertQuery('input[@name="employeeName"]');
        $this->assertQuery('input[@name="dateOfBirth"]');
        $this->assertQuery('select[@name="gender"]');
        $this->assertQuery('select[@name="facultyId"]');
        $this->assertQuery('select[@name="position"]');
        $this->assertQuery('input[@name="phone"]');
        $this->assertQuery('textarea[@name="address"]');
        $this->assertQuery('select[@name="role"]');
        $this->assertQuery('input[@name="avatar"]');
        $this->assertQuery('input[@type="submit"]');
    }

    public function testWhenPostDataNullThenShowMessageError() {
        $request = $this->getRequest();
        $request->setMethod('POST')
                ->setPost([
                    'employeeId' => '',
                    'employeeName' => '',
                    'dateOfBirth' => '',
                    'gender' => 1,
                    'facultyId' => '',
                    'position' => '',
                    'phone' => '',
                    'address' => '',
                    'role' => ''
        ]);
        $this->dispatch('/employee/profile/create-profile');

        $this->assertQueryContentContains('body', "Value is required and can't be empty");
        $this->assertQueryCount('ul.help-block > li', 8);
    }

    public function testWhenPostDataThenInsertDataToDb() {
        $request = $this->getRequest();
        $request->setMethod('POST')
                ->setPost([
                    'employeeId' => rand(100000, 999999),
                    'employeeName' => 'domanhdat',
                    'dateOfBirth' => '1993-12-01',
                    'gender' => 1,
                    'facultyId' => '1',
                    'position' => '1',
                    'phone' => '1234567890',
                    'address' => 'ha noi',
                    'role' => '1'
        ]);
        $this->dispatch('/employee/profile/create-profile');

        $this->assertRedirect();
    }

}
