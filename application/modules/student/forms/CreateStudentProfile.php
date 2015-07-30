
<?php

class Student_Form_CreateStudentProfile extends Twitter_Bootstrap3_Form_Horizontal {

    // Some notes: 
    /**
     * @author Ngo Anh Long <ngoanhlong@gmail.com>
     * If we use Twitter_Bootstrap3_Form_Horizontal to create a element follow format such as:
     * $studentId = $this->createElement('text', 'studentId');
     * Then: Type of element you must make it in lower case 'text'
     * Because: If you make the type of element in uper case 'Text', bootstrap3 is not active for U
     * Beside that: To create a element must follow the format: 
     * $studentId = $this->createElement('text', 'studentId');
     * If you have a recommendation for me, please recomment for me
     */
    public function init() {
        // Add some Attributes for this form
        // Name of form is: createProfile and method is POST to itsefl
        $this->addAttribs(['name' => 'createProfile']);
        $this->setMethod("POST");
        //Student Id
        //Not empty
        // Just contains number
        // Max length: 25
        // Min length: 6
        $studentId = $this->createElement('text', 'studentId');
        $studentId->setLabel('Mã sinh viên: ');
        $studentId->setRequired();
        $studentId->addValidator('NotEmpty', true, [
            'messages' => [
                'isEmpty' => 'Mã sinh viên yêu cầu không để trống'
            ]
        ]);
        $studentId->addValidator('digits', true, [
            'messages' => [
                'notDigits' => 'Mã sinh viên yêu cầu chỉ được là số'
            ]
        ]);
        $studentIdLengthValidate = new Zend_Validate_StringLength();
        $studentIdLengthValidate->setMax(25);
        $studentIdLengthValidate->setMin(6);
        $studentIdLengthValidate->setMessage('Mã sinh viên tối thiểu là 6 kí tự', Zend_Validate_StringLength::TOO_SHORT);
        $studentIdLengthValidate->setMessage('Mã sinh viên có độ dài tối đa là 25 kí tự', Zend_Validate_StringLength::TOO_LONG);
        $studentId->addValidator($studentIdLengthValidate);
        // studentName : 
        // Not empty
        // Just contains: Alphabet and allow white space in it
        // Max length: 50
        // Min length: 6

        $studentName = $this->createElement('text', 'studentName');
        $studentName->setLabel("Your studentName");
        $studentName->setRequired();
        $studentName->addValidator('NotEmpty', true, [
            'messages' => [
                'isEmpty' => 'Tên sinh viên yêu cầu không để trống'
            ]
        ]);
        $studentName->addValidator('Alpha', true, ['allowWhiteSpace' => true,
            'messages' => [
                'notAlpha' => 'Tên sinh viên chỉ là chữ'
            ]
        ]);
        $stringLengthValidate = new Zend_Validate_StringLength();
        $stringLengthValidate->setMax(50);
        $stringLengthValidate->setMin(6);
        $stringLengthValidate->setMessage('Tên sinh viên tối thiểu là 6 kí tự', Zend_Validate_StringLength::TOO_SHORT);
        $stringLengthValidate->setMessage('Tên sinh viên có độ dài tối đa là 50 kí tự', Zend_Validate_StringLength::TOO_LONG);
        $studentName->addValidator($stringLengthValidate);
        // dateOf birth: 
        // 1. Not Empty
        // 2. Must follow this format: dd/mm/YYYY

        $dateOfBirth = $this->createElement('text', 'dateOfBirth');
        $dateOfBirth->setLabel("Date of birth: ");
        $dateOfBirth->setAttrib('placeholder', 'dd/mm/YYYY');
        $dateOfBirth->setRequired();
        $dateOfBirth->addValidator('NotEmpty', true, [
            'messages' => [
                'isEmpty' => 'Ngày sinh yêu cầu không được để trống'
            ]
        ]);

        $dateValidator = new Zend_Validate_Date();
        $dateValidator->setFormat('dd-MM-yyyy');
        $dateValidator->setMessage("Ngày sinh của bạn phải theo định dạng: dd/mm/yyyy", Zend_Validate_Date::FALSEFORMAT);
        $dateValidator->setMessage("Ngày sinh của bạn phải theo định dạng: dd/mm/yyyy", Zend_Validate_Date::INVALID_DATE);
        $dateValidator->setMessage("Ngày sinh của bạn phải theo định dạng: dd/mm/yyyy", Zend_Validate_Date::INVALID);
        $dateOfBirth->addValidator($dateValidator);
        // Gender is a Select Box
        // Default value is 1 - male
        // And 0 - Female
        // Gender don't need validate because it has default value 

        $gender = $this->createElement('select', "gender");

        $gender->setValue("1");
        $gender->setLabel("Gender");
        $gender->setMultiOptions([
            '1' => 'Male',
            '0' => 'Female'
        ]);
//        $gender->setRequired();
//        $gender->addValidator('NotEmpty', true, [
//            'messages' => [
//                'isEmpty' => 'Giới tính yêu cầu không được để trống'
//            ]
//        ]);
        // Phone number
        // Must: 
        // 1. Not empty
        // 2. Is Integer, dont allow white space
        // After this validator, when get phone number, add number 0 to head of phone number
        // Max length: 12
        // Min length: 11
        // Note: this rule follows number of Vietnamese phone number
        $phone = $this->createElement('text', 'phone');
        $phone->setLabel("Your phone: ");
        $phone->setRequired();
        $phone->addValidator('NotEmpty', true, [
            'messages' => [
                'isEmpty' => 'Số điện thoại yêu cầu không để trống'
            ]
        ]);
        $phoneDigitValidator = new Zend_Validate_Int();
        $phoneDigitValidator->setMessage('Số điện thoại chỉ bao gồm các chữ số nguyên', Zend_Validate_Int::NOT_INT);
        $phoneLengthValidator = new Zend_Validate_StringLength();
        $phoneLengthValidator->setMax(12);
        $phoneLengthValidator->setMin(11);
        $phoneLengthValidator->setMessage('Số điện thoại tối thiểu 11 chữ số', Zend_Validate_StringLength::TOO_SHORT);
        $phoneLengthValidator->setMessage("Số điện thoại chỉ tối đa 12 chữ số", Zend_Validate_StringLength::TOO_LONG);
        $phone->addValidator($phoneDigitValidator);
        $phone->addValidator($phoneLengthValidator);

        // Address
        // Contains: 40 columns and 10 rows
        // Address can empty is Ok
        $address = $this->createElement('textarea', 'address');
        $address->setLabel("Address: ");
        $address->setAttrib('cols', '40');
        $address->setAttrib('rows', '10');

        // Submit button
        $submit = $this->createElement('submit', 'submit');
        // Add element to this form
        $this->addElements([$studentId, $studentName, $dateOfBirth, $gender, $phone, $address, $submit]);
    }
}
