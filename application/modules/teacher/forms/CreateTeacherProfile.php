<?php

/**
 * create form create teacher profile
 */
class Teacher_Form_CreateTeacherProfile extends Twitter_Bootstrap3_Form_Horizontal {

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
                ],
                [
                    'Int', true, [
                        'messages' => [
                            'notInt' => 'Mã quản trị viên chỉ chứa số'
                        ]
                    ]
                ]
            ]
        ]);

        //create teacherName element
        $this->addElement('text', 'teacherName', [
            'label' => "Họ và tên",
            'required' => true,
            'validators' => [
                [
                    'NotEmpty', true, [
                        "messages" => [
                            'isEmpty' => 'Bạn cần nhập tên giảng viên'
                        ]
                    ]
                ],
                [
                    'Alpha',true,[
                        'messages'=>[
                            'notAlpha'=>'Tên giảng viên chứa kí tự đặc biệt'
                        ]
                    ]
                ]
            ]
        ]);

        //create dateOfBirth element
        $this->addElement('text', 'dateOfBirth', [
            'placeholder' => 'mm/dd/yy',
            'label' => "Ngày sinh",
            'required' => true,
            'validators' => [
                [
                    'NotEmpty', true, [
                        "messages" => [
                            'isEmpty' => 'Bạn cần nhập ngày sinh giảng viên'
                        ]
                    ]
                ]
            ]
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
            'label' => "Bằng cấp",
            'required' => true,
            'validators' => [
                [
                    'NotEmpty', true, [
                        "messages" => [
                            'isEmpty' => 'Bạn cần nhập bằng cấp giảng viên'
                        ]
                    ]
                ]
            ]
        ]);

        //create phone element
        $this->addElement('text', 'phone', [
            'label' => "Số điện thoại",
            'required' => true,
            'validators' => [
                [
                    'NotEmpty', true, [
                        "messages" => [
                            'isEmpty' => 'Bạn cần nhập số điện thoại giảng viên'
                        ]
                    ]
                ]
            ]
        ]);

        //create address element
        $this->addElement('text', 'address', [
            'label' => "Địa chỉ",
            'required' => true,
            'validators' => [
                [
                    'NotEmpty', true, [
                        "messages" => [
                            'isEmpty' => 'Bạn cần nhập địa chỉ giảng viên'
                        ]
                    ]
                ]
            ]
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
        $this->addElement('submit', 'create',[
            'class'=>'btn btn-default dropdown-toggle disabled'
        ]);
    }

}
