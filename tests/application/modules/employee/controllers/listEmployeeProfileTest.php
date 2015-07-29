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

    public function testWhenUserAccessThenExpectedHttpCodeIs200() {
        $this->dispatch('/employee/profile/list-profile');

        $this->assertAction('list-profile');
        $this->assertModule('employee');
        $this->assertController('profile');
        $this->assertResponseCode(200);
    }

    public function testWhenUserAccessThenExpectedTitlePageFollowIdeaOfCustomer() {
        $this->dispatch('/employee/profile/list-profile');
        $this->assertQueryContentContains('title', 'Trang danh sách nhân viên');
    }

    public function testWhenUserAccessThenExpectedTitleContentFollowIdeaOfCustomer() {
        $this->dispatch('/employee/profile/list-profile');
        $this->assertQueryContentContains('h1', 'Danh sách thông tin cá nhân của nhân viên');
    }

    public function testWhenUserAccessThenExpectedContentContainsATableWithBootstrap3() {
        $this->dispatch('/employee/profile/list-profile');
        $this->assertXpath('//table[@class="table table-hover"]');
    }

    public function testWhenUserAccessThenExpectedContentContainsATableHas12Columns() {
        $this->dispatch('/employee/profile/list-profile');

        $this->assertQueryContentContains('th', 'Mã khoa');
        $this->assertQueryContentContains('th', 'Mã nhân viên');
        $this->assertQueryContentContains('th', 'Tên nhân viên');
        $this->assertQueryContentContains('th', 'Ngày sinh');
        $this->assertQueryContentContains('th', 'Giới tính');
        $this->assertQueryContentContains('th', 'Vị trí');
        $this->assertQueryContentContains('th', 'Số điện thoại');
        $this->assertQueryContentContains('th', 'Địa chỉ');
        $this->assertQueryContentContains('th', 'Vai trò');
        $this->assertQueryContentContains('th', 'Avatar');
        $this->assertQueryContentContains('a', "Sửa");
        $this->assertQueryContentContains('a', "Xóa");
    }

    public function testWhenUserAccessThenExpectedContentContains4Records() {
        $this->dispatch('/employee/profile/list-profile');
        // 4 records and 1 row is header
        $this->assertQueryCount('tr', 4);
        $this->assertXpath('//div[@class="col-md-12 text-center"]');
        $this->assertXpath('//ul[@class="pagination"]');
    }
    
    public function testWhenUserAccessThenExpectedPageIsPaginatedFollowIdeaOfCustomer()
    {
        $this->dispatch('/employee/profile/list-profile/page/1/records/3');
        // 4 records and 1 row is header
        $this->assertQueryCount('tr', 3);
        $this->assertXpath('//div[@class="col-md-12 text-center"]');
        $this->assertXpath('//ul[@class="pagination"]');
        $this->assertXpathContentContains('//a[@href="#"]', '1');
    }
}
