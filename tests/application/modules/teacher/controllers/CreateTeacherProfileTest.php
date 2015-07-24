<?php

/**
 * @author TranVanHoang <hoangtv@vnext.com.vn>
 * test create teacher profile
 */
class CreateTeacherProfileTest extends Zend_Test_PHPUnit_ControllerTestCase {

    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
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
    public function testDisplayTitle(){
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
        $this->assertQueryCount('select[name="rule"]', 1);
        $this->assertQueryCount('input[type="file"]', 1);
    }
    
    /**
     * test when inject without data will show error message
     */
    public function testInjectWithoutDataWillShowErrorMessage(){
        $this->request->setMethod('POST')
                ->setPost([
                    'teacherId' => ''
        ]);
        $this->dispatch('/teacher/profile/create');
        $this->assertQueryContentContains('body', 'Bạn cần nhập mã cho giảng viên');
    }

}
