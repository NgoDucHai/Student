<?php

/**
 * create form create teacher profile
 */
class Teacher_Form_CreateTeacherProfile extends Twitter_Bootstrap3_Form_Horizontal {

    public function init() {
        //set action, method id form

        $this->setMethod('post');

        $this->setAction('/teacher/profile/create')
                ->setMethod('post')
                ->setAttribs([
                    'id' => 'createTeacherProfile',
                    'enctype' => "multipart/form-data"
                ])
        ;

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
                    'Digits', true, [
                        'messages' => [
                            'notDigits' => 'Mã quản trị viên chỉ chứa số'
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
                    'Alpha', true, [

                        'allowWhiteSpace' => true,
                        'messages' => [
                            'notAlpha' => 'Tên giảng viên chứa kí tự đặc biệt'
                        ]
                    ]
                ]
            ]
        ]);

        //create dateOfBirth element
        $this->addElement('text', 'dateOfBirth', [
            'placeholder' => 'yyyy/mm/dd',
            'label' => "Ngày sinh",
            'required' => true,
            'validators' => [
                [
                    'NotEmpty', true, [
                        "messages" => [
                            'isEmpty' => 'Bạn cần nhập ngày sinh giảng viên'
                        ]
                    ]
                ],
                [
                    'Date', true, [
                        'format' => 'Y-M-D',
                        'messages' => [
                            'dateFalseFormat' => 'Nhập sai định dạng ngày'
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
                ],
                [
                    'Digits', true, [
                        'messages' => [
                            'notDigits' => 'So dien thoai chi co chua ki tu khong phai la so'
                        ]
                    ]
                ],
                [
                    'StringLength', true, [
                        [
                            'min' => 10,
                            'max' => 11,
                            'messages' => [
                                'stringLengthInvalid' => 'Số điện thoại phải chứa từ 10 đến 11 ký tự'
                            ]
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

        //create role element
        $this->addElement('select', 'role', [
            'label' => "Phân quyền",
            'multiOptions' => $this->__getDataRole(),
            'value' => '',
            'required' => true,
            'validators' => [
                ['NotEmpty', true]
            ],
        ]);

//        $file = new Zend_Validate_File_IsImage();
        //create avatar element
        $this->addElement('file', 'avatar', [
            'label' => "Avatar",
            'destination' => realpath(APPLICATION_PATH . '/../public/images/avatar'),
            'required' => true
        ]);

        //create button create element
        $this->addElement('submit', 'create', [
            'class' => 'btn btn-primary'
        ]);
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
