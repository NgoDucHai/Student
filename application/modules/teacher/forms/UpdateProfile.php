<?php

/**
 * @author haingo
 *  + input teacherName: chỉ chứa chữ, viết hoa chữ cái đầu, khoảng cách giữa các chữ là 1 dấu cách,
  maxlength = 50, min =6.
  + file teacherAvatar: không bắt buộc
  + input teacherId: chỉ chứa số, length=8.[readonly]
  + select teacherGender:
  + input teacherDateOfBirthDay:
  + input teacherDiploma: số
  + input teacherPhone: số
  + textarea teacherAddress: max:150
  + select teacherRole: số
 */
class Teacher_Form_UpdateProfile extends Twitter_Bootstrap3_Form_Horizontal {

    public function init() {

        $this->setMethod('POST')
                ->setAttrib('id', 'update-profile');

        $this->addElement('text','teacherId', [
            'label' => "Mã giảng viên",
            'readonly' => true,
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


        $this->addElement('text', 'teacherName', [
            'label' => "Họ và tên",
            'required' => true,
            'validators' => [
                [
                    'NotEmpty', true, [
                        "messages" => [
                            'isEmpty' => 'Bạn cần nhập họ tên cho giảng viên'
                        ]
                    ]
                ],
                [
                    'Alpha', true, [
                        'messages' => [
                            'notAlpha' => 'Tên giảng viên chỉ chứa chữ'
                        ]
                    ]
                ]
            ]
        ]);

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
        $dit = new Zend_Validate_Digits();
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
        $this->addElement('textarea', 'address', [
            'label' => "Địa chỉ",
            'rows' => 5,
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

        //create avata element
        $this->addElement('file', 'avata', [
            'label' => "Avatar"
        ]);

        //create button create element
        $this->addElement('submit', 'Update', [
            'class' => 'btn'
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
