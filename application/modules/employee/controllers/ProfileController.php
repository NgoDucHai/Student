<?php

class Employee_ProfileController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        
    }

    public function createProfileAction() {
        $this->view->headTitle('Create profile employee');
        $form = new Employee_Form_CreateProfile();

        $this->view->form = $form;

        $request = $this->getRequest(); /* @var $request Zend_Controller_Request_Http */

        if (!$request->isPost()) {
            return;
        }

        if (!$form->isValidPartial($request->getPost())) {
            return;
        }

        $employee = new Employee_Model_Employee($request->getPost());
        $empoyeeMapper = new Employee_Model_EmployeeMapper();
        $result = $empoyeeMapper->save($employee);
        $result ? $this->_helper->redirector('index') :
                        $this->_helper->redirector('index');
    }

    /**
     * show employee profile
     */
    public function showProfileAction() {
        $request = $this->getRequest();
        //if disappear id
        if (!$id = $request->getParam('id')) {
            $this->_helper->redirector('create-profile');
            return;
        }

        $employeeMapper = new Employee_Model_EmployeeMapper();
        //if employee profile doesn'nt exist
        if (!$employee = $employeeMapper->findId($id)) {
            $this->_helper->redirector('create-profile');
            return;
        }
        
        $this->view->employee = $employee;
    }

}
