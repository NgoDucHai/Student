<?php

class Student_ProfileController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function createProfileAction() {
        $this->view->headTitle("create profile");
        $form = new Student_Form_CreateProfile();
        /* @var $request Zend_Controller_Request_Http*/
        $request = $this->getRequest();
        if ($request->isPost()) {
            if($form->isValid($request->getPost()))
            {
                echo "Ok you done";
            }
        }
        $this->view->form = $form;
    }

}
