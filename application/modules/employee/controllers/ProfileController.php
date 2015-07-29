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
        
        $result = $this->__saveEmployee($request);
        if (!$result) {
            $this->_helper->redirector('index');
        }
        
        if (isset($request->getPost()->avatar)) {
            $this->__uploadFile();
        }
        $this->_helper->redirector('index');
    }

    /**
     * 
     * @param \Zend_Controller_Request_Http $request
     * @return booloean
     */
    private function __saveEmployee($request) {
        $employee = new Employee_Model_Employee($request->getPost());
        $empoyeeMapper = new Employee_Model_EmployeeMapper();
        return $empoyeeMapper->save($employee);
    }

    /**
     * upload file to server
     * @return boolean
     */
    private function __uploadFile() {
        $adapter = new Zend_File_Transfer_Adapter_Http();
        $url = realpath(APPLICATION_PATH . '/../public/images/avatar');
        $adapter->setDestination($url);
        return $adapter->receive() ? true : false;
    }

}
