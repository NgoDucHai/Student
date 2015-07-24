<?php

/**
 * @author domanhdat
 */
class Student_Form_UpdateProfile extends Zend_Form {

    public function init() {
        $this->setMethod('POST')->setAttrib('id', 'update-profile');

        $id = new Zend_Form_Element_Hidden('id');

        $studentId = new Zend_Form_Element_Text('studentId');
        $studentId->setAttrib('readonly', 'true')
                ->setLabel('Mã sinh viên');

        $studentName = new Zend_Form_Element_Text('studentName');
        $studentName->setLabel('Họ và tên');
        $studentName->setRequired();
        $validateOfStudentName = new Zend_Validate_NotEmpty();
        $validateOfStudentName->setMessage('khong de trong', Zend_Validate_NotEmpty::IS_EMPTY);
        $studentName->addValidator($validateOfStudentName);

        $dateOfBirth = new Zend_Form_Element_Text('dateOfBirth');
        $dateOfBirth->setLabel('Ngày sinh')->setRequired();

        $gender = new Zend_Form_Element_Select('gender');
        $gender->setLabel('Giới tính')->setRequired();
        $gender->addMultiOptions([
            '1' => 'Nam',
            '0' => 'Nữ'
        ]);
        $gender->setValue('1');

        $phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('Số điện thoại')->setRequired();

        $address = new Zend_Form_Element_Textarea('address');
        $address->setLabel('Địa chỉ')->setRequired();

        $submit = new Zend_Form_Element_Submit('submit');

        $this->addElements([$id, $studentId, $studentName,
            $dateOfBirth, $gender, $phone, $address, $submit]);
    }

}
