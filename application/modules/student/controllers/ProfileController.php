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
        $id = $this->getParam("i", '');
        if ($id == '')
            echo "Chua nhap vao id";
        $result = $studentM->find($id, $student);
        if (!$result) {
            echo "Id khong ton tai";
        }
        $data = [
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
        $this->view->headTitle('List Student');

        $currentPageNumber = $this->getParam("page", 1);
        $itemPerPage = $this->getParam("size", 3);
        $paginator = $this->__paginator($currentPageNumber, $itemPerPage);

        $this->view->listStudents = $paginator;
    }

    /**
     * @return \Application_Service_Paginator
     */
    private function __factoryPaginator() {
        return new Application_Service_Paginator('Student_Model_StudentMapper');
    }

    /**
     * paginate
     * @param int $currentPageNumber
     * @param int $itemPerPage
     * @return Zend_Paginator
     */
    private function __paginator($currentPageNumber, $itemPerPage) {
        $paginator = $this->__factoryPaginator();
        return $paginator->paginate($currentPageNumber, $itemPerPage);
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

    public function updateProfileAction() {
        $this->view->headTitle('Update-profile');
        $form = new Student_Form_UpdateProfile();

        $id = $this->getParam('id', '');
        if ($id == '') {
            $this->_helper->redirector('index');
        }

        $studentMapper = new Student_Model_StudentMapper();
        $result = $studentMapper->findId($id);
        if (!$result) {
            $this->view->message = "Page not found information";
            return;
        }
        $this->view->form = $form;
        $this->_processShowForm($form, $result);
        $this->_processUpdateFormProfile($form);
    }

    /**
     * luu thong tin sua doi vao database
     * @param Student_Form_UpdateProfile $form
     * @return type
     */
    protected function _processUpdateFormProfile(Student_Form_UpdateProfile $form) {
        $request = $this->getRequest(); /* @var $request Zend_Controller_Request_Http */

        if (!$request->isPost()) {
            return;
        }

        if (!$form->isValid($request->getPost())) {
            return;
        }

        $student = new Student_Model_Student($request->getPost());
        $studentMapper = new Student_Model_StudentMapper();
        $studentMapper->save($student);
    }

    /**
     * hien thi form update
     * @param Student_Form_UpdateProfile $form
     * @param Student_Model_Student $result
     */
    protected function _processShowForm(Student_Form_UpdateProfile $form, Student_Model_Student $result) {
        $form->populate([
            'studentId' => $result->getStudentId(),
            'studentName' => $result->getStudentName(),
            'dateOfBirth' => $result->getDateOfBirth(),
            'gender' => $result->getGender(),
            'phone' => $result->getPhone(),
            'address' => $result->getAddress()
        ]);
    }
}
