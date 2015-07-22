<?php

class Student_Form_Create extends Zend_Form
{

    public function init()
    {
        $studentId = $this->createElement('Text', 'studentId');
        $studentName = $this->createElement('Text', 'studentName');
        $dateOfBirth = $this->createElement('Text', 'dateOfBirth');
        $male = $this->createElement('Radio', 'gender');
        $female = $this->createElement('Radio', 'gender');
        $phone = $this->createElement('Text', 'phone');
        $address = $this->createElement('Textarea', 'Address');
        $submit = $this->createElement('Submit', 'submit');
        
        
        
        $this->addElement($studentId);
        $this->addElement($studentName);
        $this->addElement($dateOfBirth);
        $this->addElement($male);
        $this->addElement($female);
        $this->addElement($phone);
        $this->addElement($address);
        $this->addElement($submit);
    }


}

