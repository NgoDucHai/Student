<?php

class Student_ProfileController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }
    
    public function indexAction() {
        $request = $this->getRequest();
        $currentPageNumber = $this->getParam("page", 1);
        $itemPerPage = $this->getParam("size", 3);
        $paginator = $this->paginator($currentPageNumber, $itemPerPage);
        $this->view->listStudents = $paginator;
        $this->view->headTitle('List Student');
    }
    
    /**
     * @return \Application_Service_Paginator
     */
    private function factoryPaginator(){
        return new Application_Service_Paginator('Student_Model_StudentMapper');
    }
    
    /**
     * paginate
     * @param int $currentPageNumber
     * @param int $itemPerPage
     * @return Zend_Paginator
     */
    private function paginator($currentPageNumber, $itemPerPage){
        $paginator = $this->factoryPaginator();
        return $paginator->paginate($currentPageNumber, $itemPerPage);
    }
    

    public function createAction()
    {
        $this->view->headTitle("create profile");
        $form = new Student_Form_Create();
        $this->view->form = $form;
    }
}
