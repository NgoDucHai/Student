<?php

class Student_ProfileController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
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
        $this->view->form = $form;
    }
}
