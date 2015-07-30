<?php

/**
 *
 * @author domanhdat
 */
class Employee_Form_CreateProfile extends Twitter_Bootstrap3_Form_Horizontal {

    public function init() {
        $this->setMethod('POST');
        $this->setAttrib('id', 'create-profile');
        $this->setEnctype('multipart/form-data');

        $this->addElement('text', 'employeeId', [
            'label' => 'Mã nhân viên',
            'required' => true,
            'validators' => [
                ['NotEmpty', true],
                ['Digits', true]
            ],
        ]);
        $this->addElement('text', 'employeeName', [
            'label' => 'Tên nhân viên',
            'required' => true,
            'validators' => [
                ['NotEmpty', true],
                ['Alpha', true, ['allowWhiteSpace' => true]]
            ],
        ]);

        $this->addElement('date', 'dateOfBirth', [
            'label' => 'Ngày sinh',
            'placeholder' => 'yyyy-mm-dd',
            'required' => true,
            'validators' => [
                ['NotEmpty', true]
            ],
        ]);

        $this->addElement('select', 'gender', [
            'label' => 'Giới tính',
            'multiOptions' => [
                '' => 'Chọn giới tính',
                '1' => 'Nam',
                '0' => 'Nữ'
            ],
            'value' => '',
            'required' => true
        ]);


        $this->addElement('select', 'facultyId', [
            'label' => 'Khoa',
            'multiOptions' => $this->__getDataFaculty(),
            'value' => '',
            'required' => true,
            'validators' => [
                ['NotEmpty', true]
            ],
        ]);

        $this->addElement('select', 'position', [
            'label' => 'Chức danh',
            'multiOptions' => $this->__getDataPosition(),
            'value' => '',
            'required' => true,
            'validators' => [
                ['NotEmpty', true]
            ],
        ]);

        $this->addElement('number', 'phone', [
            'label' => 'Số điện thoại',
            'required' => true,
            'validators' => [
                ['NotEmpty', true],
                ['Digits', true],
                [new Zend_Validate_StringLength(['min' => 10, 'max' => 12]), true]
            ]
        ]);

        $this->addElement('textarea', 'address', [
            'label' => 'Địa chỉ',
            'required' => true,
            'rows' => 5,
            'filter' => 'Alnum'
        ]);

        $this->addElement('select', 'role', [
            'label' => 'Vị trí',
            'multiOptions' => $this->__getDataRole(),
            'value' => '',
            'required' => true,
            'validators' => [
                ['NotEmpty', true]
            ],
        ]);

        $this->addElement('file', 'avatar', [
            'label' => 'Ảnh đại diện',
            'required' => true,
            'validators' => [
                ['ExcludeMimeType', true, 'image/png,image/jpeg,image/gif'],
                ['FilesSize', true, ['min' => 0, 'max' => '4MB']]
            ]
        ]);

        $this->addElement('submit', 'submit');
    }

    private function __getDataFaculty() {
        $facultyMapper = new Application_Model_FacultyMapper();
        $listFaculty = $facultyMapper->fetchAll();

        $data[''] = 'Chọn khoa';
        if ($listFaculty) {
            foreach ($listFaculty->toArray() as $faculty):
                $data[$faculty['facultyId']] = $faculty['facultyName'];
            endforeach;
        }

        return $data;
    }
    
    /**
     * @return array contain list employee's position
     */
    private function __getDataPosition() {
        $positionMapper = new Application_Model_PositionMapper();
        $listPosition = $positionMapper->fetchAll();

        $data[''] = 'Chọn chức vụ';
        if ($listPosition) {
            foreach ($listPosition as $position):
                $data[$position->positionId] = $position->roleName;
            endforeach;
        }

        return $data;
    }
    
    private function __getDataRole() {
        $roleMapper = new Application_Model_RoleMapper();
        $listRole = $roleMapper->fetchAll();
        $data[''] = 'Chọn quyền';
        if ($listRole) {
            foreach ($listRole->toArray() as $role):
                $data[$role['roleId']] = $role['roleName'];
            endforeach;
        }
        return $data;
        
    }

}
