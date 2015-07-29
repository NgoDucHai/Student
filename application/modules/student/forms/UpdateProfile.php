<?php

/**
 * @author domanhdat
 */
class Student_Form_UpdateProfile extends Twitter_Bootstrap3_Form_Horizontal {

    public function init() {
        
        $this->setMethod('POST')->setAttrib('id', 'update-profile');
        
        $this->addElement('hidden', 'id');

        $this->addElement('text', 'studentId', [
            'readonly' => true,
            'label' => 'Mã sinh viên'
        ]);

        $this->addElement('text', 'studentName', [
            'label' => 'Họ và tên',
            'required' => true,
            'validator' => ['NotEmpty', true],
        ]);

        $this->addElement('date', 'dateOfBirth', [
            'label' => 'Ngày sinh',
            'required' => true,
            'validators' => [
                ['Date', true]
            ]
        ]);

        $this->addElement('select', 'gender', [
            'label' => 'Giới tính',
            'multiOptions' => [
                '1' => 'Nam',
                '0' => 'Nữ'
            ],
            'value' => '1'
        ]);

        $this->addElement('number', 'phone', [
            'label' => 'Số điện thoại',
            'required' => true,
            'validators' => [
                [new Zend_Validate_StringLength(['min' => 10, 'max' => 12]), true]
            ]
        ]);

        $this->addElement('textarea', 'address', [
            'label' => 'Địa chỉ',
            'required' => true,
            'rows' => 5,
            'filter' => 'Alnum'
        ]);

        $this->addElement('submit', 'submit');
    }

}
