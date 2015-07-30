<?php

/**
 * @author Ngo Anh Long <ngoanhlong@gmail.com> 
 */
class deleteEmployeeProfileTest extends Vms_Test_PHPUnit_ControllerWithDatabaseFixturesTestCase {

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
                    'avatar' => 'defaultAvatar.jpg',
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
                    'avatar' => 'defaultAvatar.jpg',
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
                    'avatar' => 'defaultAvatar.jpg',
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
                    'avatar' => 'defaultAvatar.jpg',
                ]
        ]]);
    }

    public function testWhenUserAccessThenExpectedHttpCodeIs302() {
        $this->dispatch('/employee/profile/delete');

        $this->assertAction('delete');
        $this->assertModule('employee');
        $this->assertController('profile');
        $this->assertRedirectTo('/employee/profile/list-profile');
    }

    public function testWhenUserInputANotExistsIdThenExpectedTitlePageFollowIdeaOfCustomer() {
        $this->dispatch('/employee/profile/delete/id/1202');
        $this->assertRedirectTo('/employee/profile/list-profile');
    }

    public function testWhenUserInputAExistsIdThenRedirectThemToListProfilePage() {
        $this->dispatch('/employee/profile/delete/id/12023232');
        $this->assertRedirectTo('/employee/profile/list-profile');
    }

}
