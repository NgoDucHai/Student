<?php

/**
 * create form create teacher profile
 */
class Teacher_Form_CreateTeacherProfile extends Zend_Form {

    public function init() {
        //set action, method id form
        $this->setAction('/teacher/profile/create')
                ->setMethod('post')
                ->setAttrib('id', 'createTeacherProfile');

        //create teacherId element
        $this->addElement('text', 'teacherId', [
            'label' => "Mã giảng viên",
            'required' => true,
            'validators' => [
                [
                    'NotEmpty', true, [
                        "messages" => [
                            'isEmpty' => 'Bạn cần nhập mã cho giảng viên'
                        ]
                    ]
                ]
            ]
        ]);
        
        //create teacherName element
        $this->addElement('text', 'teacherName', [
            'label' => "Họ và tên"
        ]);
        
        //create dateOfBirth element
        $this->addElement('text', 'dateOfBirth', [
            'placeholder'=>'mm/dd/yy',
            'label' => "Ngày sinh"
        ]);

        //create gender element
        $this->addElement('select', 'gender', [
            'label' => "Giới tính",
            'multiOptions' => [
                '1' => 'Nam',
                '0' => 'Nữ'
            ]
        ]);

        //create diploma element
        $this->addElement('text', 'diploma', [
            'label' => "Bằng cấp"
        ]);

        //create phone element
        $this->addElement('text', 'phone', [
            'label' => "Số điện thoại"
        ]);

        //create address element
        $this->addElement('text', 'address', [
            'label' => "Địa chỉ"
        ]);

        //create rule element
        $this->addElement('select', 'rule', [
            'label' => "Phân quyền",
            'multiOptions' => [
                '1' => 'Quản trị'
            ]
        ]);

        //create avata element
        $this->addElement('file', 'avata', [
            'label' => "Avatar"
        ]);

        //create button create element
        $this->addElement('submit', 'create');
    }

}
