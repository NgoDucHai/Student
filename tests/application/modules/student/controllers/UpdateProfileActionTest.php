<?php

/**
 * @author domanhdat
 */
class updateProfileActionTest extends Vms_Test_PHPUnit_ControllerWithDatabaseFixturesTestCase {

    protected $truncateFixturesWhenTearDown = false;

    protected function getDataSet() {
        return new PHPUnit_Extensions_Database_DataSet_ArrayDataSet([
            "student" => [
                [
                    "studentId" => '1135678',
                    "studentName" => "domanhdat",
                    "dateOfBirth" => '1993-12-13',
                    "gender" => '1',
                    "phone" => '1234567898',
                    "address" => 'ha noi'
                ],
            ]
        ]);
    }

    public function testWhenAccessUrlThenReturnHttpCode200() {
        $this->dispatch('/student/profile/update-profile/id/1135678');

        $this->assertResponseCode(200);
    }

    public function testWhenAccessPageUpdateProfileThenDisplayTitle() {
        $this->dispatch('/student/profile/update-profile/id/1135678');

        $this->assertQueryContentContains('head', 'Update-profile');
    }

    public function testWhenAccessPageUpdateProfileThenDisplayForm() {
        $this->dispatch('/student/profile/update-profile/id/1135678');

        $this->assertQuery('form#update-profile');

        $this->assertQuery('input[@name="studentId"][@readonly="readonly"]');
        $this->assertQuery('input[@name="studentName"]');
        $this->assertQuery('input[@name="dateOfBirth"]');
        $this->assertQuery('select[@name="gender"]');
        $this->assertQuery('input[@name="phone"]');
        $this->assertQuery('textarea[@name="address"]');
    }

    public function testWhenAccessPageUpdateProfileThenDisplayInformation() {
        $this->dispatch('/student/profile/update-profile/id/1135678');

        $this->assertQueryContentContains('label', 'Mã sinh viên');
        $this->assertQueryContentContains('label', 'Họ và tên');
        $this->assertQueryContentContains('label', 'Ngày sinh');
        $this->assertQueryContentContains('label', 'Giới tính');
        $this->assertQueryContentContains('label', 'Số điện thoại');
        $this->assertQueryContentContains('label', 'Địa chỉ');
    }

    public function testWhenAccessPageUpdateProfileWidthIdNullThenRedirectPageIndex() {
        $this->dispatch('/student/profile/update-profile');

        $this->assertRedirectTo('/student/profile');
    }

    public function testWhenAccessPageUpdateWidthIdNotFindOnDbThenDispLayPageNotFoundInformation() {
        $this->dispatch('/student/profile/update-profile/id/3');

        $this->assertQueryContentContains('body', 'Page not found information');
    }

    public function testWhenAccessPageUpdateProfileThenDisplayInformationOfStudent() {
        $this->dispatch('/student/profile/update-profile/id/1135678');

        $this->assertQuery('input[@value="1135678"]');
        $this->assertQuery('input[@value="domanhdat"]');
        $this->assertQuery('input[@value="1993-12-13"]');
        $this->assertQuery('option[@value="1"][@selected="selected"]');
        $this->assertQuery('input[@value="1234567898"]');
        $this->assertQueryContentContains('textarea', 'ha noi');
    }

    public function testWhenChangeInformationThenShowDisplayInformationIsChange() {
        $this->request->setMethod('POST')
                ->setPost([
                    'studentId' => '1135678',
                    'studentName' => 'domanhdat1',
                    'dateOfBirth' => '1995-12-24',
                    'gender' => '0',
                    'phone' => '987654321',
                    'address' => 'hoa binh'
        ]);
        $this->dispatch('/student/profile/update-profile/id/1135678');

        $this->assertQuery('input[@value="1135678"]');
        $this->assertQuery('input[@value="domanhdat1"]');
        $this->assertQuery('input[@value="1995-12-24"]');
        $this->assertQuery('option[@value="0"][@selected="selected"]');
        $this->assertQuery('input[@value="987654321"]');
        $this->assertQueryContentContains('textarea', 'hoa binh');
    }

}
