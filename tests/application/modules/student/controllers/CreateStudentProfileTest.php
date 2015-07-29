<?php

/**
 * @author Ngo Anh Long  <ngoanhlong@gmail.com>
 */
class CreateStudentProfileTest extends Vms_Test_PHPUnit_ControllerWithDatabaseFixturesTestCase {

    // prepare 4 records to intergrate with db 
    protected $truncateFixturesWhenTearDown = true;

    // Male is true OR 1 
    // Female is false OR 0
    // Date of Birth format: yyyy/mm/dd


    protected function getDataSet() {
        return new PHPUnit_Extensions_Database_DataSet_ArrayDataSet(
                ['student' => [
                ['studentId' => '12020535',
                    'studentName' => 'Ngo Anh Long',
                    'dateOfBirth' => '1994/04/18',
                    'gender' => 1,
                    'phone' => '01663669281',
                    'address' => 'Quang Ninh'
                ],
                ['studentId' => '12020323',
                    'studentName' => 'Ngo Duc Hai',
                    'dateOfBirth' => '1994/10/10',
                    'gender' => 1,
                    'phone' => '01628349289',
                    'address' => 'Bac Giang'
                ],
                ['studentId' => '11343232',
                    'studentName' => 'Do Manh Dat',
                    'dateOfBirth' => '1994/6/9',
                    'gender' => 1,
                    'phone' => '01628340000',
                    'address' => 'Hoa Binh'
                ],
                ['studentId' => '130232732',
                    'studentName' => 'Hoang',
                    'dateOfBirth' => '1996/9/6',
                    'gender' => 1,
                    'phone' => '01628341111',
                    'address' => 'Hai Phong'
                ]
        ]]);
    }

    public function testWhenUserAccessThenExpectedHttpCodeIs200() {
        $this->dispatch('student/profile/create-profile');

        $this->assertResponseCode(200);
        $this->assertAction('create-profile');
        $this->assertModule('student');
        $this->assertController('profile');
    }

    public function testWhenUserAccessThenExpectedPageTitleFollowCustomerIdea() {
        $customerIdea = "create profile";
        $this->dispatch('student/profile/create-profile');

        $this->assertQueryContentContains('title', $customerIdea);
    }

    public function testWhenUserAccessThenExpectedPageHasAFormAndFieldsNeedToFill() {
        $this->dispatch('student/profile/create-profile');

        $this->assertXpath('//form[@name="createProfile"]');
        $this->assertXpath('//input[@type="text"][@name="studentId"]');
        $this->assertXpath('//input[@type="text"][@name="dateOfBirth"]');
        $this->assertXpath('//select[@name="gender"]');
        $this->assertXpath('//input[@type="text"][@name="phone"]');
        $this->assertXpath('//textarea[@rows="10"][@cols="40"]');
        $this->assertXpath('//input[@type="submit"]');
    }

    public function testIfUserCreateUserHasAStudentIDExistsThenExpectedPageContentContainsMessageError() {
        $this->request->setMethod("POST")
                ->setPost(
                ['studentId' => '12020535',
                    'studentName' => 'NgoAnhLong',
                    'dateOfBirth' => '18/04/1994',
                    'gender' => 1,
                    'phone' => '01663669281',
                    'address' => 'Quang Ninh'
        ]);

        $this->dispatch('/student/profile/create-profile');
        $this->assertQueryContentContains('body', 'Your studentId is Exists');
    }

    public function testIfUserCreateAUserNotExistsInDBThenExpectedPageContentContainsMessageSuccess() {
        $this->request->setMethod("POST")
                ->setPost(
                ['studentId' => '317231232',
                    'studentName' => 'Ngo Anh',
                    'dateOfBirth' => '18/04/1994',
                    'gender' => 1,
                    'phone' => '01663669999',
                    'address' => 'Quang Ninh'
        ]);

        $this->dispatch('/student/profile/create-profile');
        $this->assertQueryContentContains('body', "Ok you've created a User");
    }

    public function testIfUserInputEmptyValueIntoRequiredFieldThenDisplayAErrorMessage() {
        $this->request->setMethod('POST')
              ->setPost([
                  'studentId' => '',
                  'studentName' => '',
                  'dateOfBirth' => '',
                  'gender' =>'',
                  'phone' =>'',
                  'address' => ''
              ]);

        $this->dispatch('/student/profile/create-profile');
        $this->assertQueryContentContains('li', "Mã sinh viên yêu cầu không để trống");
        $this->assertQueryContentContains('li', "Tên sinh viên yêu cầu không để trống");
        $this->assertQueryContentContains('li', "Ngày sinh yêu cầu không được để trống");
        $this->assertQueryContentContains('li', "Số điện thoại yêu cầu không để trống");
    }
    
    public function testIfUserInputStudentIdIsNotIntegerThenDisplayExpectedErrorMessage() {
        $this->request->setMethod("POST")
                ->setPost(
                ['studentId' => 'jkahdsfjkasd',
                    'studentName' => 'Ngo Anh',
                    'dateOfBirth' => '18/04/1994',
                    'gender' => 1,
                    'phone' => '01663669999',
                    'address' => 'Quang Ninh'
        ]);

        $this->dispatch('/student/profile/create-profile');
        $this->assertQueryContentContains('li', "Mã sinh viên yêu cầu chỉ được là số");
    }
    
     public function testIfUserInputStudentNameIsNotAlphabetThenDisplayExpectedErrorMessage() {
        $this->request->setMethod("POST")
                ->setPost(
                ['studentId' => '3846281',
                    'studentName' => '1231njfds',
                    'dateOfBirth' => '18/04/1994',
                    'gender' => 1,
                    'phone' => '01663669999',
                    'address' => 'Quang Ninh'
        ]);

        $this->dispatch('/student/profile/create-profile');
        $this->assertQueryContentContains('li', "Tên sinh viên chỉ là chữ");
    }
    
    public function testIfUserInputStudentNameOverMaxLengthThenDisplayExpectedErrorMessage() {
        $this->request->setMethod("POST")
                ->setPost(
                ['studentId' => '3846281',
                    'studentName' => 'fjkahsdjkffasdfasdfsdjfhjaksdhfjkahsjdkfhjkhajksdhjfkahsjkdhfjkashdjkfhajksdhfjkahsdjkfhajksdhfjkahsdjfhajksdhfjkahsdjkf',
                    'dateOfBirth' => '18/04/1994',
                    'gender' => 1,
                    'phone' => '01663669999',
                    'address' => 'Quang Ninh'
        ]);

        $this->dispatch('/student/profile/create-profile');
        $this->assertQueryContentContains('li', "Tên sinh viên có độ dài tối đa là 50 kí tự");
    }

    public function testIfUserInputStudentNameOverTooShortThenDisplayExpectedErrorMessage() {
        $this->request->setMethod("POST")
                ->setPost(
                ['studentId' => '3846281',
                    'studentName' => 'ưer',
                    'dateOfBirth' => '18/04/1994',
                    'gender' => 1,
                    'phone' => '01663669999',
                    'address' => 'Quang Ninh'
        ]);

        $this->dispatch('/student/profile/create-profile');
        $this->assertQueryContentContains('li', "Tên sinh viên tối thiểu là 6 kí tự");
    }
    
    public function testIfUserInputStudentIdIsTooShortThenDisplayExpectedErrorMessage() {
        $this->request->setMethod("POST")
                ->setPost(
                ['studentId' => '384',
                    'studentName' => 'ưer',
                    'dateOfBirth' => '18/04/1994',
                    'gender' => 1,
                    'phone' => '01663669999',
                    'address' => 'Quang Ninh'
        ]);

        $this->dispatch('/student/profile/create-profile');
        $this->assertQueryContentContains('li', "Mã sinh viên tối thiểu là 6 kí tự");
    }
    
    public function testIfUserInputStudentIdIsTooLongThenDisplayExpectedErrorMessage() {
        $this->request->setMethod("POST")
                ->setPost(
                ['studentId' => '38412317263716273617236176327162371673617236716',
                    'studentName' => 'ưer',
                    'dateOfBirth' => '18/04/1994',
                    'gender' => 1,
                    'phone' => '01663669999',
                    'address' => 'Quang Ninh'
        ]);

        $this->dispatch('/student/profile/create-profile');
        $this->assertQueryContentContains('li', "Mã sinh viên có độ dài tối đa là 25 kí tự");
    }
    
    
    public function testIfUserInputBirthdayInvalidThenDisplayExpectedErrorMessage() {
        $this->request->setMethod("POST")
                ->setPost(
                ['studentId' => '12020534',
                    'studentName' => 'Ngo Anh Long',
                    'dateOfBirth' => '36213',
                    'gender' => 1,
                    'phone' => '01663669999',
                    'address' => 'Quang Ninh'
        ]);

        $this->dispatch('/student/profile/create-profile');
        $this->assertQueryContentContains('li', "Ngày sinh của bạn phải theo định dạng: dd/mm/yyyy");
        
    }
    
    public function testIfUserInputInvalidPhoneNumberThenDisplayExpectedErrorMessage() {
        $this->request->setMethod("POST")
                ->setPost(
                ['studentId' => '12020534',
                    'studentName' => 'Ngo Anh Long',
                    'dateOfBirth' => '18/04/1994',
                    'gender' => 1,
                    'phone' => '01a637d23232',
                    'address' => 'Quang Ninh'
        ]);

        $this->dispatch('/student/profile/create-profile');
        $this->assertQueryContentContains('li', "Số điện thoại chỉ bao gồm các chữ số nguyên");
        
    }
    
    public function testIfUserInputTooLongPhoneNumberThenDisplayExpectedErrorMessage() {
        $this->request->setMethod("POST")
                ->setPost(
                ['studentId' => '12020534',
                    'studentName' => 'Ngo Anh Long',
                    'dateOfBirth' => '18/04/1994',
                    'gender' => 1,
                    'phone' => '072321313232232',
                    'address' => 'Quang Ninh'
        ]);

        $this->dispatch('/student/profile/create-profile');
        $this->assertQueryContentContains('li', "Số điện thoại chỉ tối đa 12 chữ số");
        
    }
    
    public function testIfUserInputTooShortPhoneNumberThenDisplayExpectedErrorMessage() {
        $this->request->setMethod("POST")
                ->setPost(
                ['studentId' => '12020534',
                    'studentName' => 'Ngo Anh Long',
                    'dateOfBirth' => '18/04/1994',
                    'gender' => 1,
                    'phone' => '0723',
                    'address' => 'Quang Ninh'
        ]);

        $this->dispatch('/student/profile/create-profile');
        $this->assertQueryContentContains('li', "Số điện thoại tối thiểu 11 chữ số");
        
    }
    
}
