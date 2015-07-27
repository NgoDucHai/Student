<?php

class Teacher_ProfileController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        
    }
    public function updateProfileAction() {
        $this->view->headTitle('Update Profile');
        $form = new Teacher_Form_UpdateProfile();

        $id = $this->getParam('id', '');
        if ($id == '') {
            $this->_helper->redirector('index');
        }

        $teacherMapper = new Teacher_Model_TeacherMapper();
        $result = $teacherMapper->findId($id);
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
        $teacherMapper->save($teacher);
    }

    /**
     * hien thi form update
     * @param Teacher_Form_UpdateProfile $form
     * @param Teacher_Model_Teacher $result
     */
    protected function _processShowForm(Teacher_Form_UpdateProfile $form, Teacher_Model_Teacher $result) {
        $form->populate([
            'teachertId' => $result->getTeacherId(),
            'teacherName' => $result->getTeacherName(),
            'dateOfBirth' => $result->getDateOfBirth(),
            'diploma' =>$result->getDiploma(),
            'gender' => $result->getGender(),
            'phone' => $result->getPhone(),
            'address' => $result->getAddress(),
            'rule' =>$result->getRule()
        ]);
    }
}
