<?php

/**
 * Description of update-profile
 *
 * @author haingo
 */
class UpdateProfileTeacherActionTest extends Vms_Test_PHPUnit_ControllerWithDatabaseFixturesTestCase {

    protected $truncateFixturesWhenTearDown = false;

    protected function getDataSet() {
        return new PHPUnit_Extensions_Database_DataSet_ArrayDataSet([
            "teacher" => [
                [
                    "teacherId" => '1',
                    "teacherName" => "Ngo Duc Hai",
                    "dateOfBirth" => '1994-03-06',
                    "gender" => '1',
                    "diploma" => '1',
                    "phone" => '1234567898',
                    "role" => '1',
                    "address" => 'ha noi',
                   
                ],
            ]
        ]);
    }

    
    public function testWhenAccessUrlThenReturnHttpCode200() {
        $this->dispatch('/teacher/profile/update-profile/id/1');
        $this->assertResponseCode(200);
    }

    public function testWhenCallActionThenGoToUrlTeacherProfileUpdate() {
        $this->dispatch('/teacher/profile/update-profile');
        $this->assertModule('teacher');
        $this->assertController('profile');
        $this->assertAction('update-profile');
    }
    
    
    public function testWhenAccessPageUpdateProfileThenDisplayForm() {
        $this->dispatch('/teacher/profile/update-profile/id/1');

        $this->assertQuery('form#update-profile');

        $this->assertQuery('input[@name="teacherId"]');
        $this->assertQuery('input[@name="teacherName"]');
        $this->assertQuery('input[@name="dateOfBirth"]');
        $this->assertQuery('select[@name="gender"]');
        $this->assertQuery('input[@name="phone"]');
        $this->assertQuery('textarea[@name="address"]');
        $this->assertQuery('input[@name="diploma"]');
        $this->assertQuery('select[@name="role"]');
        $this->assertQuery('input[@name="avata"]');
    }
    
    public function testWhenAccessPageUpdateProfileThenDisplayInformation() {
        $this->dispatch('/teacher/profile/update-profile/id/1');

        $this->assertQueryContentContains('label', 'Mã giảng viên');
        $this->assertQueryContentContains('label', 'Họ và tên');
        $this->assertQueryContentContains('label', 'Ngày sinh');
        $this->assertQueryContentContains('label', 'Giới tính');
        $this->assertQueryContentContains('label', 'Bằng cấp');
        $this->assertQueryContentContains('label', 'Số điện thoại');
        $this->assertQueryContentContains('label', 'Địa chỉ');
        $this->assertQueryContentContains('label', 'Phân quyền');
    }

    public function testWhenAccessPageUpdateProfileWidthIdNullThenRedirectPageIndex() {
        $this->dispatch('/teacher/profile/update-profile');

        $this->assertRedirectTo('/teacher/profile/list-profile');
    }

    public function testWhenAccessPageUpdateWidthIdNotFindOnDbThenDispLayPageNotFoundInformation() {
        $this->dispatch('/teacher/profile/update-profile/id/3');

        $this->assertQueryContentContains('body', 'Giang vien khong ton tai ');
    }
    
    public function testShowInformationOldBeforeUpdateInformation() {
        $this->request->setMethod('POST')
                ->setPost([
                    "teacherId" => '1',
                    "teacherName" => "NgoDucHai",
                    "dateOfBirth" => '1994-03-06',
                    "gender" => '1',
                    "diploma" => '1',
                    "phone" => '1234567898',
                    "role" => '1',
                    "address" => 'ha noi'
        ]);
        $this->dispatch('/teacher/profile/update-profile/id/1');
        $this->assertQuery('input[@value="1"]');
        $this->assertQuery('input[@value="NgoDucHai"]');
        $this->assertQuery('input[@value="1994-03-06"]');
        $this->assertQuery('option[@value="1"]');
        $this->assertQuery('input[@value="1234567898"]');
        $this->assertQueryContentContains("textarea", 'ha noi');
        $this->assertQuery('option[@value="1"]');
        $this->assertQuery('option[@value="1"]');
        
        //$this->assertQuery('input[@value="avata"]');
    }
    
    
//    public function testIfInformationOkThenImportRequestIntoBD() {
//        $this->request->setMethod('POST')
//                ->setPost([
//                    "teacherId" => '1',
//                    "teacherName" => "NgoDucHaiedit",
//                    "dateOfBirth" => '1994-03-06',
//                    "gender" => '1',
//                    "diploma" => '1',
//                    "phone" => '1234567898',
//                    "role" => '1',
//                    "address" => 'ha noi'
//        ]);
//        $this->dispatch('/teacher/profile/update-profile/id/1');
//        $this->assertRedirectTo("teacher/profile/show-profile/id/1");
//        
//    }
}
