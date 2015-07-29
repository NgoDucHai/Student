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
        $result = $mapper->getAllProfiles();
        $page = $this->_getParam('page', 1);
        $record = $this->_getParam('records', 5);
        $paginator = Zend_Paginator::factory($result);
        $paginator->setItemCountPerPage($record);
        $paginator->setCurrentPageNumber($page);

        $this->view->paginator = $paginator;

//        $this->view->profiles = $employeeProfiles;
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
        
        if (FALSE !== $idExists) {
            $mapper->deleteById($id);
            $this->_helper->redirector('list-profile');
        }
    }

}
