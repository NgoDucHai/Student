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
        
        if (!$form->isValid($request->getPost())) {
            var_dump($request->getPost());exit;
            return;
        }
        
        $adapter = $this->__uploadImage();

        $teacher = new Teacher_Model_Teacher($request->getPost());
        $teacher->setAvatar($adapter->getFileName());

        $dbMapper = new Teacher_Model_TeacherMapper();
        if ($dbMapper->save($teacher)) {
            $adapter->receive();
            $this->_helper->redirector('list-profile');
        }
    }

    /**
     * upload avatar image 
     * @return \Zend_File_Transfer_Adapter_Http
     */
    private function __uploadImage() {
        $adapter = new Zend_File_Transfer_Adapter_Http();
        $uploadPath = realpath(APPLICATION_PATH . '/../public/images/avatar');
        $adapter->setDestination($uploadPath);

        return $adapter;
    }

    public function deleteProfileAction() {
        $id = (int) $this->getParam('id', '');
        !$id ? $this->_helper->redirector('list-profile') : true;

        $teacherMapper = new Teacher_Model_TeacherMapper();
        $result = $teacherMapper->findId($id);

        !$result ? $this->_helper->redirector('list-profile') : $teacherMapper->deleteId($id);
        $this->_helper->redirector('list-profile');
    }

}
