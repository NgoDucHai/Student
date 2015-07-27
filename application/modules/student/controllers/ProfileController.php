<?php

class Student_ProfileController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        $data['dateOfBirth'] = '22-10-1993';
        $this->__changeFormatDateOfBirth($data);
        die;
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
        $this->view->headTitle("create profile");
        $form = new Student_Form_CreateProfile();
        /* @var $request Zend_Controller_Request_Http */
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
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

    private function __changeFormatDateOfBirth($data) {
        if (!($dateOfBirth = $data['dateOfBirth'])) {
            return;
        }
        $listDate = preg_split('/[-\/.]/', $dateOfBirth);
        var_dump($listDate);die;
        $data['dateOfBirth'] = $listDate[2] . "-" . $listDate[1] . "-" . $listDate;
    }

}
