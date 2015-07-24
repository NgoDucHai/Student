<?php
/**
 * test create teacher profile form
 */
class FormCreateTeacherProfileTest extends PHPUnit_Framework_TestCase{
    protected $__createTeacherProfileForm;

    protected function setUp() {
        parent::setUp();
        $this->__createTeacherProfileForm = new Teacher_Form_CreateTeacherProfile();
        $application = new Zend_Application(APPLICATION_ENV,APPLICATION_PATH.'/configs/application.ini');
        $application->getBootstrap()->bootstrap();
    }
    
    public function testTest(){
        $form = $this->__createTeacherProfileForm;

        $data=[
            'teacherId'=>''
        ];
        $this->assertFalse($form->isValid($data));
        
        $data=[
            'teacherId'=>'lkjnhbv'
        ];
        $this->assertTrue($form->isValid($data));
        
    }
}