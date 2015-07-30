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

        $id = $this->getParam('id', '');
        if (!$id) {
            $this->_helper->redirector('list-profile');
        }

        $teacherMapper = new Teacher_Model_TeacherMapper();
        $result = $teacherMapper->findId($id);
        
        if (!$result) {
            $this->view->message = "Giang vien khong ton tai ";
            return;
        }
        $this->view->form = $form;
        $this->_processShowForm($form, $result);
        if ($this->_processUpdateFormProfile($form)) {
            $this->view->message = "Update success";
            $params = array('id' => $id);
            $this->_helper->redirector("show-profile", 'profile', 'teacher', $params);
        }
    }

    /**
     * save infomation new into database
     * @param Teacher_Form_UpdateProfile $form
     * @return true or false
     */
    protected function _processUpdateFormProfile(Teacher_Form_UpdateProfile $form) {
        $request = $this->getRequest(); /* @var $request Zend_Controller_Request_Http */

        if (!$request->isPost()) {
            return false;
        }

        if (!$form->isValid($request->getPost())) {
            return false;
        }

        $teacher = new Teacher_Model_Teacher($request->getPost());
        $teacherMapper = new Teacher_Model_TeacherMapper();
        if ($teacherMapper->saveProfile($teacher)) {
            return true;
        } else {
            return FALSE;
        }
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
            'role' => $result->getRole()
        ]);
    }

    public function listProfileAction() {
        $this->view->headTitle('List profile teacher');

        $currentPageNumber = $this->getParam('page', 1);
        $itemPerPage = $this->getParam('size', 5);

        $paginator = $this->__getFactoryPaginateTeacher($currentPageNumber, $itemPerPage);

        $this->view->listTeacher = $paginator;
    }

    /**
     * @param integer $currentPageNumber
     * @param integer $itemPerPage
     * @return Zend_paginator
     */
    private function __getFactoryPaginateTeacher($currentPageNumber, $itemPerPage) {
        $dbMapper = new Teacher_Model_TeacherMapper();
        return Application_Service_Paginator::factory($dbMapper, $currentPageNumber, $itemPerPage);
    }

    /**
     * create teacher profile
     */
    public function createAction() {
        $this->view->headTitle('Create teacher profile');

        $form = new Teacher_Form_CreateTeacherProfile();
        $request = $this->getRequest(); /* @var $request Zend_Controller_Request_Http */

        $this->view->form = $form;

        if (!$request->isPost()) {
            return;
        }

        if (!$form->isValidPartial($request->getPost())) {
            return;
        }
        
        $adapter = new Zend_File_Transfer_Adapter_Http();
        $teacher = new Teacher_Model_Teacher($request->getPost());
        $teacher->setAvatar($adapter->getFileName());
        
        //if data is inserted into database successfully, image will be uploaded
        //and page will be redirected to index teacher profile page
        $dbMapper = new Teacher_Model_TeacherMapper();
        if ($dbMapper->save($teacher)) {
            $adapter->receive();
            $this->_helper->redirector('list-profile');
        }
    }

    public function deleteProfileAction() {
        $id = $this->getParam('id', '');
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
        $id = $this->getParam('id', '');

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
