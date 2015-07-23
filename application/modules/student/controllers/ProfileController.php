<?php

class Student_ProfileController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function showAction() {
        $this->view->headTitle('Show Profile');
        $form = new Student_Form_ShowProfile();
        $student = new Student_Model_Student();
        $studentM = new Student_Model_StudentMapper();
        //kiem tra id tu request
        $id = $this->getParam("id", '');
        if ($id == '')
            echo "Chua nhap vao id";
        $result = $studentM->find($id, $student);
        if (!$result) {
            echo "Id khong ton tai";
        }
        $data = [
            "id" => $id,
            "studentId" => $student->getStudentId(),
            'studentName' => $student->getStudentName(),
            'dateOfBirth' => $student->getDateOfBirth(),
            "gender" => $student->getGender(),
            "phone" => $student->getPhone(),
            "address" => $student->getAddress()
        ];
        $form->populate($data);
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
    private function factoryPaginator() {
        return new Application_Service_Paginator('Student_Model_StudentMapper');
    }

    /**
     * paginate
     * @param int $currentPageNumber
     * @param int $itemPerPage
     * @return Zend_Paginator
     */
    private function paginator($currentPageNumber, $itemPerPage) {
        $paginator = $this->factoryPaginator();
        return $paginator->paginate($currentPageNumber, $itemPerPage);
    }

    public function createAction() {
        $this->view->headTitle("create profile");
        $form = new Student_Form_Create();
        $this->view->form = $form;
    }

}
