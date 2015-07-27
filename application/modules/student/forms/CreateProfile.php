<?php

class Student_Form_CreateProfile extends Zend_Form {

    public function init() {
        
        // Add some Attributes for this form
        $this->addAttribs(['name' => 'createProfile']);
        $this->setMethod("POST");
        $this->setAction('/student/profile/create-profile');
        //Student Id
        $studentId = $this->createElement('Text', 'studentId');
        $studentId->setLabel('Mã sinh viên: ');
        $studentId->setRequired();
        $studentId->addValidator('NotEmpty', true, [
            'messages' => [
                'isEmpty' => 'Mã sinh viên yêu cầu không để trống'
            ]
        ]);
        

        //studentName : 
        $studentName = $this->createElement('Text', 'studentName');
        $studentName->setLabel("Your studentName");
//        $studentName->addVa

        // dateOf birth: 
        $dateOfBirth = $this->createElement('Text', 'dateOfBirth');
        $dateOfBirth->setLabel("Date of birth: ");
        
        // Gender is a Select Box
        
        $gender = new Zend_Form_Element_Select("gender");
        $gender->setLabel("Gender");
        $gender->setMultiOptions([
            '1' => 'Male',
            '0' => 'Female'
        ]);
        
        // Phone number
        $phone = $this->createElement('Text', 'phone');
        $phone->setLabel("Your phone: ");
        
        // Address
        $address = new Zend_Form_Element_Textarea("address");
        $address->setLabel("Address: ");
        $address->setAttrib('cols', '40');
        $address->setAttrib('rows', '10');
        $submit = $this->createElement('Submit', 'submit');



        $this->addElements([$studentId, $studentName, $dateOfBirth, $gender, $phone, $address, $submit]);
    }

}
