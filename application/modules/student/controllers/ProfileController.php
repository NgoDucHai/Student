<?php

class Student_ProfileController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    /**
     * Display profile student
     * @return Student_Model_Student
     */
    public function showProfileAction() {
        $this->view->headTitle('Show Profile');
        
        //kiem tra id tu request
        $id = $this->getParam("id", '');
        if ($id == '') {
            $this->_helper->redirector('index');
        }
        $studentM = new Student_Model_StudentMapper();
        $result = $studentM->findId($id);
        if (!$result) {
            $this->view->message = "Page not found information";
            return;
        }
        /* @var $result Student_Model_Student */
        $this->view->student = $result;
    }

    /**
     * show list student profile paginated
     */
    public function indexAction() {
        $this->view->headTitle('List Student');

        $currentPageNumber = $this->getParam("page", 1);
        $itemPerPage = $this->getParam("size", 3);

        $paginator = $this->__factoryPaginator($currentPageNumber, $itemPerPage);
        $this->view->listStudents = $paginator;
    }

    /**
     * 
     * @param integer $currentPageNumber
     * @param integer $itemPerPage
     * @return Zend_Paginator
     */
    private function __factoryPaginator($currentPageNumber, $itemPerPage) {
        $studentMapper = new Student_Model_StudentMapper();
        return Application_Service_Paginator::factory($studentMapper, $currentPageNumber, $itemPerPage);
    }

    public function createProfileAction() {
        /* @var $request Zend_Controller_Request_Http */
        $this->view->headTitle("create profile");
        $form = new Student_Form_CreateStudentProfile();
        $request = $this->getRequest();
        // Get handle request or post invalid profile then show profile form
        $this->view->form = $form;
        $userVisitCreateProfilePage = !$request->isPost();
        if ($userVisitCreateProfilePage) {
            return; //Render profile form now
        }
        //Post handler request:
        $userPostInvalidProfile = !$form->isValid($request->getPost());
        if ($userPostInvalidProfile) {
            return; //Render profile form with error messages now
        }
        $profileUser = $request->getPost();
        $mapper = new Student_Model_StudentMapper();

        if (FALSE === $mapper->findId($profileUser['studentId'])) {
            $studentObj = new Student_Model_Student($profileUser);
            $mapper->save($studentObj);
            $this->view->message = "Ok you've created a User";

            return;
        }

        $this->view->message = "Your studentId is Exists";
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
