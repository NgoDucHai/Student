<?php

/**
 * Description of UpdateEmployeeProfile
 *
 * @author haingo
 */
class Employee_Form_UpdateProfile extends Twitter_Bootstrap3_Form_Horizontal {

    public function init() {
        $this->setMethod('post')
                ->setAttrib('id', 'update-profile');

        $this->addElement('text', 'employeeId', [
            'label' => "Mã nhân viên",
            'readonly' => true,
            'required' => true,
            'validators' => [
                [
                    'NotEmpty', true, [
                        "messages" => [
                            'isEmpty' => "Bạn cần nhập mã cho nhân viên"
                        ]
                    ]
                ],
                [
                    'Digits', true, [
                        'messages' => [
                            'notDigits' => "Mã nhân viên chỉ chứa số"
                        ]
                    ]
                ]
            ]
        ]);

        $this->addElement('text', 'employeeName', [
            'label' => "Họ và tên",
            'required' => true,
            'validators' => [
                [
                    'NotEmpty', true, [
                        "messages" => [
                            'isEmpty' => ' Bạn cần nhập họ tên cho nhân viên'
                        ]
                    ]
                ],
                [
                    'Alpha', true, [
                        'messages' => [
                            'notAlpha' => 'Tên nhân viên chỉ chứa chữ'
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
                            'isEmpty' => 'Bạn cần nhập ngày sinh nhân viên'
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
                '' => 'Chọn giới tính',
                '1' => 'Nam',
                '0' => 'Nữ'
            ]
        ]);

        $this->addElement('select', 'facultyId', [
            'label' => "Khoa",
            'multiOptions' => $this->__getDataFaculty(),
            'value' => '',
            'required' => true,
            'validators' => [
                ['NotEmpty', true]
            ],
        ]);

        $this->addElement('select', 'position', [
            'label' => "Vị trí",
            'multiOptions' => [
                '' => 'Chọn',
                '1' => 'Quản lý',
                '0' => 'Thư ký'
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
                            'isEmpty' => 'Bạn cần nhập số điện thoại nhân viên'
                        ]
                    ]
                ],
                [
                    'Digits', true, [
                        'messages' => [
                            'notDigits' => 'Số điện thoại chỉ gồm các số'
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
        //create rule element
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
        $this->addElement('file', 'avatar', [
            'label' => "Avatar",
        ]);

        //create button create element
        $this->addElement('submit', 'Update', [
            'class' => 'btn'
        ]);
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
