<?php

class Teacher_Bootstrap extends Zend_Application_Module_Bootstrap {

    public function _initPagiantor() {
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial(
                ['/index/paginator.phtml', 'default']
        );
    }

}
