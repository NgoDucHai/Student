<?php

class Employee_ProfileController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        
    }

    /** 
     * @author Ngo Anh Long <ngoanhlong@gmail.com>
     */
    public function listProfileAction() {
        $this->view->headTitle("List Employee Profile Page");
        $this->view->titleContent = "List Of Employee Profile";
        $mapper = new Employee_Model_EmployeeMapper();
        $employeeProfiles = $mapper->getDbTable()->fetchAll();
        
    }
    /** 
     * @author Ngo Anh Long <ngoanhlong@gmail.com>
     */
    public function deleteAction() {
        
    }

}
