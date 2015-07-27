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
  + select teacherRule: số
 */
class Teacher_Form_UpdateProfile extends Twitter_Bootstrap3_Form_Horizontal {

    public function init() {
        $this->setMethod('POST')
                ->setAttrib('id', 'update-profile');

        $id = new Zend_Form_Element_Hidden('id');

        $teacherId = new Zend_Form_Element_Text('teacherId');
        $teacherId->setAttrib('readonly', 'true')
                ->setLabel('Mã giảng viên');

        $teacherName = new Zend_Form_Element_Text('teacherName');
        $teacherName->setLabel('Họ và tên')
                ->setRequired();

        $dateOfBirth = new Zend_Form_Element_Text('dateOfBirth');
        $dateOfBirth->setLabel('Ngày sinh')
                ->setRequired();

        $gender = new Zend_Form_Element_Select('gender');
        $gender->setLabel('Giới tính')
                ->setRequired();
        $gender->addMultiOptions([
            '1' => 'Nam',
            '0' => 'Nữ'
        ]);
        $gender->setValue('1');

        $diploma = new Zend_Form_Element_Select('diploma');
        $diploma->setLabel('Chức vụ')
                ->setRequired();
        $diploma->addMultiOptions([
            '2' => 'Khoa',
            '1' => 'Giảng viên',
            '0' => 'Sinh viên'
        ]);
        $diploma->setValue('1');

        $phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('Số điện thoại')
                ->setRequired();

        $address = new Zend_Form_Element_Textarea('address');
        $address->setAttrib('rows', 5);
        $address->setLabel('Địa chỉ')
                ->setRequired();

        $rule = new Zend_Form_Element_Select('rule');
        $rule->setLabel('Phân quyền')
                ->setRequired();
        $rule->addMultiOptions([
            '2' => 'Quản trị',
            '1' => 'Người dùng',
            '0' => 'Khách'
        ]);
        $rule->setValue('1');
        
        $submit = new Zend_Form_Element_Submit('submit');

        $this->addElements([$id, $teacherId, $teacherName,
            $dateOfBirth, $gender, $diploma, $phone, $address, $rule, $submit]);
    }

}
