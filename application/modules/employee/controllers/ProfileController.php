<?php

class Employee_ProfileController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        
    }

    /**
     * Update profile Employee
     * @return type
     */
    public function updateProfileAction() {
        $this->view->headTitle('Update Profile');
        $form = new Employee_Form_UpdateProfile();

        $id = (int) $this->getParam('id', '');
        if (!$id) {
            $this->_helper->redirector('list-profile');
        }

        $employeeMapper = new Employee_Model_EmployeeMapper();
        $result = $employeeMapper->findId($id);
        if (!$result) {
            $this->view->message = "Nhan vien khong ton tai";
            return;
        }
        $this->view->form = $form;
        
        //set up URL image
        $adapter = new Zend_File_Transfer_Adapter_Http();
        $uploadPath = APPLICATION_PATH . '/../public/images/avatar';
        $adapter->setDestination($uploadPath);
        $adapter->addFilter('Rename',$result->getEmployeeId().'.jpg');
        $this->view->fileName = $result->getEmployeeId().'.jpg';
        if (!$adapter->receive()) {
            $messages = $adapter->getMessages();
        }
        $avatar = $adapter->getFileName();
        $this->_processShowForm($form, $result);
        if ($this->_processUpdateFormProfile($form)) {
            echo "Update success";
            $this->view->message = "Update success";
            $params = array('id' => $id);
            $this->_helper->redirector("show-profile", 'profile', 'employee', $params);
        }
    }

    /**
     * Get information into form from request
     * @param Employee_Form_UpdateProfile $form
     * @param Employee_Model_Employee $result
     */
    protected function _processShowForm(Employee_Form_UpdateProfile $form, Employee_Model_Employee $result) {
        $form->populate(
                [
                    'employeeId' => $result->getEmployeeId(),
                    'employeeName' => $result->getEmployeeName(),
                    'dateOfBirth' => $result->getDateOfBirth(),
                    'gender' => $result->getGender(),
                    'facultyId' => $result->getFacultyId(),
                    'position' => $result->getPosition(),
                    'phone' => $result->getPhone(),
                    'address' => $result->getAddress(),
                    'role' => $result->getRole(),
                   // 'avatar' => $result->getAvatar()
                    
        ]);
    }
    
    /**
     * Save information from request into DB
     * @param Employee_Form_UpdateProfile $form
     * @return boolean
     */

    protected function _processUpdateFormProfile(Employee_Form_UpdateProfile $form) {
        $request = $this->getRequest(); /* @var $request Zend_Controller_Request_Http */

        if (!$request->isPost()) {
            return false;
        }

        if (!$form->isValid($request->getPost())) {
            return false;
        }

        $employee = new Employee_Model_Employee($request->getPost());
        $employeeMapper = new Employee_Model_EmployeeMapper();
        if ($employeeMapper->saveProfile($employee)) {
            return true;
        } else {
            return FALSE;
        }
    }

    
}
