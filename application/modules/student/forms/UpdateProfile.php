<?php

/**
 * @author domanhdat
 */
class Student_Form_UpdateProfile extends Zend_Form {

    public function init() {
        $this->setMethod('POST')
                ->setAttrib('id', 'update-profile');

<<<<<<< HEAD
        $this->addElement('text', 'studentName', [
            'label' => 'Họ và tên',
            'required' => true,
            'validator' => ['NotEmpty', true],
        ]);
        
        $this->addElement('date', 'dateOfBirth', [
            'label' => 'Ngày sinh',
            'required' => true,
            'validators' => [
                ['Date', true, ['options' => ['format' => 'yyyy-MM-dd']]]
            ]
        ]);
=======
        $id = new Zend_Form_Element_Hidden('id');

        $studentId = new Zend_Form_Element_Text('studentId');
        $studentId->setAttrib('readonly', 'true')
                ->setLabel('Mã sinh viên');
>>>>>>> b6d5b6c74dbb0b8cc7c49cfaf1f655f4518c7fe7

        $studentName = new Zend_Form_Element_Text('studentName');
        $studentName->setLabel('Họ và tên')
                ->setRequired();

<<<<<<< HEAD
        $this->addElement('number', 'phone', [
            'label' => 'Số điện thoại',
            'required' => true,
            'validators' => [
                [new Zend_Validate_StringLength(['min' => 10, 'max' => 12]), true],
                [new Zend_Validate_Digits(), true]
            ]
        ]);
=======
        $dateOfBirth = new Zend_Form_Element_Text('dateOfBirth');
        $dateOfBirth->setLabel('Ngày sinh')
                ->setRequired();
>>>>>>> b6d5b6c74dbb0b8cc7c49cfaf1f655f4518c7fe7

        $gender = new Zend_Form_Element_Select('gender');
        $gender->setLabel('Giới tính')
                ->setRequired();
        $gender->addMultiOptions([
            '1' => 'Nam',
            '0' => 'Nữ'
        ]);
        $gender->setValue('1');

        $phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('Số điện thoại')
                ->setRequired();

        $address = new Zend_Form_Element_Textarea('address');
        $address->setLabel('Địa chỉ')
                ->setRequired();

        $submit = new Zend_Form_Element_Submit('submit');

        $this->addElements([$id, $studentId, $studentName,
            $dateOfBirth, $gender, $phone, $address, $submit]);
    }

}
