<?php

/**
 * Test UpdateEmployee
 * 
 *
 * @author haingo
 */
class UpdateEmployeeProfileTest extends Vms_Test_PHPUnit_ControllerWithDatabaseFixturesTestCase {

    protected $truncateFixturesWhenTearDown = false;

    protected function getDataSet() {
        return new PHPUnit_Extensions_Database_DataSet_ArrayDataSet([
            'employee' => [
                [
                    'employeeId' => '1',
                    'employeeName' => 'NgoDucHai',
                    'dateOfBirth' => '1994-03-06',
                    'gender' => '1',
                    'facultyId' => '1',
                    'position' => '1',
                    'phone' => '01659338885',
                    'address' => 'Tan Yen - Bac Giang',
                    'role' => '1',
                    'avatar' => 'ss'
                ]
            ]
        ]);
    }

    public function testWhenAccessPageUpdateEmployeeProfileThenDisplayForm() {
        $this->dispatch('/employee/profile/update-profile/id/1');

        $this->assertQuery('form#update-profile');
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
    }

    public function testWhenAccessPageUpdateProfileThenDisplayInformation() {
        $this->dispatch('/employee/profile/update-profile/id/1');

        $this->assertQueryContentContains('label', 'Mã nhân viên');
        $this->assertQueryContentContains('label', 'Họ và tên');
        $this->assertQueryContentContains('label', 'Ngày sinh');
        $this->assertQueryContentContains('label', 'Giới tính');
        $this->assertQueryContentContains('label', 'Khoa');
        $this->assertQueryContentContains('label', 'Vị trí');
        $this->assertQueryContentContains('label', 'Số điện thoại');
        $this->assertQueryContentContains('label', 'Địa chỉ');
        $this->assertQueryContentContains('label', 'Phân quyền');
        $this->assertQueryContentContains('label', 'Avatar');
    }

    public function testShowInaformationOldBeforeUpdateInformation() {
//        $this->request->setMethod('POST')
//                ->setPost([
//                    'employeeId' => '1',
//                    'employeeName' => 'NgoDucHai',
//                    'dateOfBirth' => '1994-03-06',
//                    'gender' => '1',
//                    'facultyId' => '1',
//                    'position' => '1',
//                    'phone' => '01659338885',
//                    'address' => 'Tan Yen - Bac Giang',
//                    'role' => '1',
//                    'avatar' => 'ss'
//        ]);
        $this->dispatch('/employee/profile/update-profile/id/1');
        $this->assertQuery('input[@id="employeeId"][@value="1"]');
        $this->assertQuery('input[@value="NgoDucHai"]');
        $this->assertQuery('input[@value="1994-03-06"]');
        $this->assertQuery('option[@value="1"]');
        $this->assertQuery('option[@value="1"]');
        $this->assertQuery('option[@value="1"]');
        $this->assertQuery('input[@value="01659338885"]');
        $this->assertQueryContentContains("textarea", 'Tan Yen - Bac Giang');
        $this->assertQuery('option[@value="1"]');
        //$this->assertQuery('input[@value = "avatar"]');
    }

}
