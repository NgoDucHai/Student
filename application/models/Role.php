<?php

/**
 *
 * @author haingo
 */
class Application_Model_Role extends Application_Model_Abstract {

    protected $_roleId;
    protected $_roleName;
            function get_roleId() {
        return $this->_roleId;
    }

    function get_roleName() {
        return $this->_roleName;
    }

    function set_roleId($roleId) {
        $this->_roleId = $roleId;
    }

    function set_roleName($roleName) {
        $this->_roleName = $roleName;
    }


   

}
