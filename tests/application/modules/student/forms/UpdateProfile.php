<?php

/**
 * Description of UpdateProfile
 *
 * @author linux
 */
class UpdateProfile extends PHPUnit_Framework_TestCase {

    protected $_form;

    public function setUp() {
        parent::setUp();
        $app = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        $app->getBootstrap()->bootstrap();
        $this->_form = new Student_Form_UpdateProfile();
    }

    public function testWhenSubmitDataFailThenReturnFalse() {
        $this->assertTrue($this->_form->isValid([
                    'studentName' => 'haha'
        ]));
    }

}
