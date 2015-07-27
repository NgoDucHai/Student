<?php

class Teacher_ProfileController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        
    }

    public function listProfileAction() {
        $this->view->headTitle('List profile teacher');

        $currentPageNumber = $this->getParam('page', 1);
        $itemPerPage = $this->getParam('size', 5);

        $paginator = $this->__getFactoryListTeacher($currentPageNumber, $itemPerPage);

        $this->view->listTeacher = $paginator;
    }

    /**
     * 
     * @param integer $currentPageNumber
     * @param integer $itemPerPage
     * @return Zend_paginator
     */
    private function __getFactoryListTeacher($currentPageNumber, $itemPerPage) {
        $dbMapper = new Teacher_Model_TeacherMapper();
        return Application_Service_Paginator::factory($dbMapper, $currentPageNumber, $itemPerPage);
    }

    /**
     * create teacher profile
     */
    public function createAction() {
        $this->view->headTitle('Create teacher profile');
        $form = new Teacher_Form_CreateTeacherProfile();
        $request = $this->getRequest();

        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                
                //begin upload avatar image
                $adapter = new Zend_File_Transfer_Adapter_Http();
                $uploadPath = APPLICATION_PATH . '/../public/images/avatar';
                $adapter->setDestination($uploadPath);

                if (!$adapter->receive()) {
                    $messages = $adapter->getMessages();
                }
                //end upload avatar image
                
                //begin insert data to database
                $avatar = $adapter->getFileName();
                $teacher = $this->__setData(new Teacher_Model_Teacher, $request, $avatar);
                $dbMapper = new Teacher_Model_TeacherMapper();
                if(!$dbMapper->save($teacher))
                    $this->_helper->redirector('list-profile');
                //end insert data to database
            }
        }

        $this->view->form = $form;
    }

    /**
     * set data teacher profile
     * @param Teacher_Model_Teacher $teacher
     * @param Zend_Controller_Request_Abstract $request
     * @param string $avatar
     * @return \Teacher_Model_Teacher
     */
    private function __setData(Teacher_Model_Teacher $teacher, $request, $avatar) {
        $teacher->setTeacherId($request->getParam('teacherId'))
                ->setTeacherName($request->getParam('teacherName'))
                ->setDateOfBirth($request->getParam('dateOfBirth'))
                ->setGender($request->getParam('gender'))
                ->setDiploma($request->getParam('diploma'))
                ->setPhone($request->getParam('phone'))
                ->setAddress($request->getParam('address'))
                ->setRule($request->getParam('rule'))
                ->setAvatar($avatar)
        ;
        
        return $teacher;
    }

}
