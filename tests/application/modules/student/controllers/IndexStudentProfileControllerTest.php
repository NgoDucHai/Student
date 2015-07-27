<?php
/**
 * test index student profile when having no data
 */
class IndexStudentProfileControllerTest extends Zend_Test_PHPUnit_ControllerTestCase {

    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }
    
    /**
     * test access to index student profile is ok
     */
    public function testWhenAccessToIndexStudentProfileWillReturnHttpCode200(){
        $this->dispatch('student/profile/index');
        $this->assertResponseCode(200);
    }
    
    /**
     * test display index student profile page. Index student profile have title being "List Student"
     * and content is "Empty list student"
     */
    public function testDisplayIndexStudentProfilePage(){
        $this->dispatch('student/profile/index');
        $this->assertModule('student');
        $this->assertController('profile');
        $this->assertAction('index');
        
        $this->assertQueryContentContains('title','List Student');
        $this->assertQueryContentContains('body','Empty list student');
    }
    
}
