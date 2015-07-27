<?php

class Teacher_ProfileController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        
    }

    /**
     * Update profile Teacher
     * @return type
     */
    public function updateProfileAction() {
        $this->view->headTitle('Update Profile');
        $form = new Teacher_Form_UpdateProfile();

        $id = (int) $this->getParam('id', '');
        if (!$id) {
            $this->_helper->redirector('index');
        }

        $teacherMapper = new Teacher_Model_TeacherMapper();
        $result = $teacherMapper->findId($id);
        if (!$result) {
            $this->view->message = "Giang vien khong ton tai ";
            return;
        }
        $this->view->form = $form;
        $this->_processShowForm($form, $result);
        $this->_processUpdateFormProfile($form);
    }

    /**
     * save infomation new into database
     * @param Teacher_Form_UpdateProfile $form
     * @return type
     */
    protected function _processUpdateFormProfile(Teacher_Form_UpdateProfile $form) {
        $request = $this->getRequest(); /* @var $request Zend_Controller_Request_Http */

        if (!$request->isPost()) {
            return;
        }

        if (!$form->isValid($request->getPost())) {
            return;
        }

        $teacher = new Teacher_Model_Teacher($request->getPost());
        $teacherMapper = new Teacher_Model_TeacherMapper();
        $teacherMapper->saveProfile($teacher);
    }

    /**
     * display form update
     * @param Teacher_Form_UpdateProfile $form
     * @param Teacher_Model_Teacher $result
     */
    protected function _processShowForm(Teacher_Form_UpdateProfile $form, Teacher_Model_Teacher $result) {
        $form->populate([
            'teacherId' => $result->getTeacherId(),
            'teacherName' => $result->getTeacherName(),
            'dateOfBirth' => $result->getDateOfBirth(),
            'diploma' => $result->getDiploma(),
            'gender' => $result->getGender(),
            'phone' => $result->getPhone(),
            'address' => $result->getAddress(),
            'rule' => $result->getRule()
        ]);
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
                if (!$dbMapper->save($teacher))
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

    public function deleteProfileAction() {
        $id = (int) $this->getParam('id', '');
        !$id ? $this->_helper->redirector('list-profile') : true;

        $teacherMapper = new Teacher_Model_TeacherMapper();
        $result = $teacherMapper->findId($id);

        !$result ? $this->_helper->redirector('list-profile') : $teacherMapper->deleteId($id);
        $this->_helper->redirector('list-profile');
    }

    /**
     * @author Ngo Anh Long <ngoanhlong@gmail.com>
     * show profile of a Teacher
     */
    public function showProfileAction() {
        
        $this->view->headTitle("show profile of teacher");
        $id = (int) $this->getParam('id', '');

        if (!$id) {
            $this->_helper->redirector('list-profile');
        }
        
        $mapper = new Teacher_Model_TeacherMapper();
        $result = $mapper->findId($id);
        if (!$result) {
            $this->view->errorMessage = "Profile not found";
        }
        
        $this->view->title = "Profile of teacher";
        $this->view->profileTeacher = $result;
    }

}
