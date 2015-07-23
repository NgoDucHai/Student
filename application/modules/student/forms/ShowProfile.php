<?php

class Student_Form_ShowProfile extends Zend_Form {

    public function init() {
        //$this->setMethod("post");
        $this->setAttrib('id', 'showprofile');

        $studentId = new Zend_Form_Element_Text('studentId');
        $studentId->setLabel("Mã sinh viên: ");
        $studentId->setRequired();
        $this->addElement($studentId);
        $userName = new Zend_Form_Element_Text('studentName');
        $userName->setLabel("Họ và tên: ");
        $userName->setRequired();

        $this->addElement($userName);
        $dateOfBirth = new Zend_Form_Element_Text('dateOfBirth');
        $dateOfBirth->setLabel("Ngày sinh: ");
        $dateOfBirth->setRequired();

        $this->addElement($dateOfBirth);

        // cach 2 nen dung, ho tro cac method
        $gender = new Zend_Form_Element_Text('gender');
        $gender->setLabel('Giới tính: ');
        $gender->setRequired();


        $this->addElement($gender);

        $phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('Số điện thoại: ');
        $phone->setRequired();

        $this->addElement($phone);


        $address = new Zend_Form_Element_Text('address');
        $address->setLabel('Địa chỉ: ');
        $address->setRequired();

        $this->addElement($address);
    }

}
