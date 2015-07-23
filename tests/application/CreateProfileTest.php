<?php

/**
 * @author Ngo Anh Long  <ngoanhlong@gmail.com>
 */
class CreateProfileTesting extends Vms_Test_PHPUnit_ControllerWithDatabaseFixturesTestCase {

    // prepare 4 records to intergrate with db 
    protected $truncateFixturesWhenTearDown = false;

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
                    'phone' => '0166 366 9281',
                    'address' => 'Quang Ninh'
                ],
                ['studentId' => '12020323',
                    'studentName' => 'Ngo Duc Hai',
                    'dateOfBirth' => '1994/10/10',
                    'gender' => 1,
                    'phone' => '0162 834 9289',
                    'address' => 'Bac Giang'
                ],
                ['studentId' => '11343232',
                    'studentName' => 'Do Manh Dat',
                    'dateOfBirth' => '1994/6/9',
                    'gender' => 1,
                    'phone' => '0162 834 0000',
                    'address' => 'Hoa Binh'
                ],
                ['studentId' => '130232732',
                    'studentName' => 'Hoang',
                    'dateOfBirth' => '1996/9/6',
                    'gender' => 1,
                    'phone' => '0162 834 1111',
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
                    'studentName' => 'Ngo Anh Long',
                    'dateOfBirth' => '1994/04/18',
                    'gender' => 1,
                    'phone' => '0166 366 9281',
                    'address' => 'Quang Ninh'
        ]);

        $this->dispatch('/student/profile/create-profile');
        $this->assertQueryContentContains('body', 'Your studentId is Exists');
    }

    public function testIfUserCreateAUserNotExistsInDBThenExpectedPageContentContainsMessageSuccess() {
        $this->request->setMethod("POST")
                ->setPost(
                ['studentId' => '12353473',
                    'studentName' => 'Ngo Anh',
                    'dateOfBirth' => '1995/04/18',
                    'gender' => 1,
                    'phone' => '0166 366 9999',
                    'address' => 'Quang Ninh'
        ]);

        $this->dispatch('/student/profile/create');
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
        $this->assertQueryContentContains('li', "Giới tính yêu cầu không được để trống");
        $this->assertQueryContentContains('li', "Số điện thoại yêu cầu không để trống");
        $this->assertQueryContentContains('li', "Địa chỉ yêu cầu không để trống");
    }

}
