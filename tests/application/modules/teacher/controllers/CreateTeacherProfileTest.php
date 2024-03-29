<?php

/**
 * @author TranVanHoang <hoangtv@vnext.com.vn>
 * test create teacher profile
 */
class CreateTeacherProfileTest extends Vms_Test_PHPUnit_ControllerWithDatabaseFixturesTestCase {

    protected $truncateFixturesWhenTearDown = true;

    protected function getDataSet() {
        return new PHPUnit_Extensions_Database_DataSet_ArrayDataSet([
            "role" => [
                [
                    "roleId" => '1',
                    "roleName"=>'abc'
                ]
            ]
        ]);
    }

    /**
     * test access to create teacher profile page is ok
     */
    public function testAccessToCreateTeacherProfileWillReturnHttpCode200() {
        $this->dispatch('teacher/profile/create');

        $this->assertResponseCode(200);
    }

    /**
     * test create display title being 'Create teacher profile'
     */
    public function testDisplayTitle() {
        $this->dispatch('teacher/profile/create');
        $this->assertQueryContentContains('head', 'Create teacher profile');
    }

    /**
     * test elements's form create teacher profile
     */
    public function testFormCreateTeacherProfile() {
        $this->dispatch('teacher/profile/create');

        $this->assertQueryCount('form#createTeacherProfile', 1);
        $this->assertQueryCount('input[name="teacherId"]', 1);
        $this->assertQueryCount('input[name="teacherName"]', 1);
        $this->assertQueryCount('input[name="dateOfBirth"]', 1);
        $this->assertQueryCount('select[name="gender"]', 1);
        $this->assertQueryCount('input[name="diploma"]', 1);
        $this->assertQueryCount('input[name="phone"]', 1);
        $this->assertQueryCount('input[name="address"]', 1);
        $this->assertQueryCount('select[name="role"]', 1);
        $this->assertQueryCount('input[type="file"]', 1);
    }

    /**
     * test when inject without data will show error message
     */
    public function testInjectWithoutDataWillShowErrorMessage() {
        $this->request->setMethod('POST')
                ->setPost([
                    'teacherId' => '',
                    'teacherName' => '',
                    'dateOfBirth' => '',
                    'gender' => '',
                    'diploma' => '',
                    'phone' => '',
                    'address' => ''
        ]);
        $this->dispatch('/teacher/profile/create');

        $this->assertQueryContentContains('li', 'Bạn cần nhập mã cho giảng viên');
        $this->assertQueryContentContains('li', 'Bạn cần nhập tên giảng viên');
        $this->assertQueryContentContains('li', 'Bạn cần nhập ngày sinh giảng viên');
        $this->assertQueryContentContains('li', 'Bạn cần nhập bằng cấp giảng viên');
        $this->assertQueryContentContains('li', 'Bạn cần nhập số điện thoại giảng viên');
        $this->assertQueryContentContains('li', 'Bạn cần nhập địa chỉ giảng viên');
    }

    /**
     * test submit with bad data will show error message
     */
    public function testSubmitBadDataWillShowErrorMessage() {
        $this->request->setMethod('POST')
                ->setPost([
                    'teacherId' => '09e5drcgvhbjnkl',
                    'teacherName' => 'iojhoio5-09uj0j0w340-o',
                    'dateOfBirth' => '19/22/31',
                    'phone' => '86yui09jio'
        ]);
        $this->dispatch('/teacher/profile/create');

        $this->assertQueryContentContains('li', 'Mã quản trị viên chỉ chứa số');
        $this->assertQueryContentContains('li', 'Tên giảng viên chứa kí tự đặc biệt');
        $this->assertQueryContentContains('li', 'Nhập sai định dạng ngày');
        $this->assertQueryContentContains('li', 'So dien thoai chi co chua ki tu khong phai la so');
    }

    /**
     * test when submit with good data, page will be 
     * redirected to list teacher profile page
     */
    public function testSubmitWithGoodData() {
        $data = [
            'teacherId' => '1212332322132',
            'teacherName' => 'tetststststs',
            'dateOfBirth' => '1999/11/1',
            'gender' => '1',
            'diploma' => '111',
            'phone' => '1233213231',
            'address' => 'sfdrgk',
            'role' => '1'
            ];


        $this->request->setMethod('POST')
                ->setPost($data);

        $this->dispatch('/teacher/profile/create');
        $this->assertResponseCode(302);
    }
    
    /**
     * removing data after testing create teacher profile with good data
     */
    public function tearDown() {
        $this->dispatch('/teacher/profile/delete-profile/id/1212332322132');
    }

}
