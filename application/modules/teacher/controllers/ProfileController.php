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

}
