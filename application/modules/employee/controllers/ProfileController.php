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

    

  
    public function listProfileAction() {
        $this->view->headTitle("Trang danh sách nhân viên");
        $this->view->titleContent = "Danh sách thông tin cá nhân của nhân viên";
        $mapper = new Employee_Model_EmployeeMapper();

        // Pagination
        /* @var $result Zend_Db_Table_Rowset_Abstract */
        /**
         * default records is 5, and default current page is 1
         */
        $result = $mapper->getDbTable()->select();
        $page = $this->_getParam('page', 1);
        $record = $this->_getParam('records', 5);
        $paginator = Zend_Paginator::factory($result);
        $paginator->setItemCountPerPage($record);
        $paginator->setCurrentPageNumber($page);

        $this->view->paginator = $paginator;
    }

    /**
     * @author Ngo Anh Long <ngoanhlong@gmail.com>
     * 
     * If id not null then check in db if that is not exists then redirect them to list-profile page
     * If id not null and that is is exists in Db then display a message
     * If id null then redirect user to list-profile page
     */
    public function deleteAction() {
        $id = $this->getRequest()->getParam('id', '');
        $mapper = new Employee_Model_EmployeeMapper();
        $idExists = $mapper->findById($id);
            $this->_helper->redirector('list-profile');
        // Delete avatar then delete profile in db
        if (FALSE !== $idExists) {
//            unlink($mapper->getAvatarById($id));
            $mapper->deleteById($id);
        }
        $this->_helper->redirector('list-profile');
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
