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
        $this->view->deleteMessage = "";
        $mapper = new Employee_Model_EmployeeMapper();
        $idExists = $mapper->findById($id);
        if('' == $id){
            $this->_helper->redirector('list-profile');
        }
        if (FALSE === $idExists) {
            $this->view->headTitle("Trang xóa thông tin người dùng");
            $this->view->deleteMessage = "ID không tồn tại";
            return;
        }
        // Delete avatar then delete profile in db
        if (FALSE !== $idExists) {
            unlink($mapper->getAvatarById($id));
            $mapper->deleteById($id);
            $this->_helper->redirector('list-profile');
        }
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
