<?php

/**
 * @author Ngo Anh Long <ngoanhlong@gmail.com> 
 */
class ListEmployeeProfileTest extends Vms_Test_PHPUnit_ControllerWithDatabaseFixturesTestCase {

    protected $truncateFixturesWhenTearDown = false;

    protected function getDataSet() {

        return new PHPUnit_Extensions_Database_DataSet_ArrayDataSet([
            "employee" => [
                [
                    'employeeId' => '12020535',
                    'employeeName' => 'Ngo Anh Long',
                    'dateOfBirth' => '1994/04/18',
                    'gender' => 1,
                    'facultyId' => 'ItFal123',
                    'position' => 1,
                    'phone' => '01663669281',
                    'address' => 'Quang Ninh',
                    'role' => 2,
                    'avatar' => 'no avatar',
                ],
                [
                    'employeeId' => '12020533',
                    'employeeName' => 'Do Manh Dat',
                    'dateOfBirth' => '1993/04/18',
                    'gender' => 1,
                    'facultyId' => 'ItFal123',
                    'position' => 1,
                    'phone' => '01663669281',
                    'address' => 'Hoa Binh',
                    'role' => 2,
                    'avatar' => 'no avatar',
                ],
                [
                    'employeeId' => '12023232',
                    'employeeName' => 'Ngo Duc Hai',
                    'dateOfBirth' => '1994/06/26',
                    'gender' => 1,
                    'facultyId' => 'ItFal123',
                    'position' => 0,
                    'phone' => '01663669381',
                    'address' => 'Bac Giang',
                    'role' => 2,
                    'avatar' => 'no avatar',
                ],
                [
                    'employeeId' => '12023262',
                    'employeeName' => 'Tran Van Hoang',
                    'dateOfBirth' => '1996/06/27',
                    'gender' => 2,
                    'facultyId' => 'ItFal124',
                    'position' => 2,
                    'phone' => '01663669323',
                    'address' => 'Hai Phong',
                    'role' => 2,
                    'avatar' => 'no avatar',
                ]
        ]]);
    }

    public function testWhenUserAccessThenExpectedHttpCodeIs200() {
        $this->dispatch('/employee/profile/list-profile');

        $this->assertAction('list-profile');
        $this->assertModule('employee');
        $this->assertController('profile');
        $this->assertResponseCode(200);
    }

    public function testWhenUserAccessThenExpectedTitlePageFollowIdeaOfCustomer() {
        $this->dispatch('/employee/profile/list-profile');
        $this->assertQueryContentContains('title', 'List Employee Profile Page');
    }

    public function testWhenUserAccessThenExpectedTitleContentFollowIdeaOfCustomer() {
        $this->dispatch('/employee/profile/list-profile');
        $this->assertQueryContentContains('h1', 'List Of Employee Profile');
    }

    public function testWhenUserAccessThenExpectedContentContainsATableWithBootstrap3() {
        $this->dispatch('/employee/profile/list-profile');
        $this->assertXpath('//table[@class="table table-hover"]');
    }

    public function testWhenUserAccessThenExpectedContentContainsATableHas12Columns() {
        $this->dispatch('/employee/profile/list-profile');

        $this->assertQueryContentContains('th', 'employeeId');
        $this->assertQueryContentContains('th', 'employeeName');
        $this->assertQueryContentContains('th', 'dateOfBirth');
        $this->assertQueryContentContains('th', 'gender');
        $this->assertQueryContentContains('th', 'facultyId');
        $this->assertQueryContentContains('th', 'position');
        $this->assertQueryContentContains('th', 'phone');
        $this->assertQueryContentContains('th', 'address');
        $this->assertQueryContentContains('th', 'role');
        $this->assertQueryContentContains('th', 'avatar');
        $this->assertQuery('th');
        $this->assertQuery('th');
    }

    public function testWhenUserAccessThenExpectedContentContains4Records() {
        $this->dispatch('/employee/profile/list-profile');
        // 4 records and 1 row is header
        $this->assertQueryCount('tr', 5);
    }

}
