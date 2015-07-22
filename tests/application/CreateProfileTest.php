<?php

/**
 * @author Ngo Anh Long  <ngoanhlong@gmail.com>
 */
class CreateProfileTesting extends Vms_Test_PHPUnit_ControllerWithDatabaseFixturesTestCase {

    // prepare 4 records to intergrate with db 
    protected $truncateFixturesWhenTearDown = true;

    // Male is true OR 1 
    // Female is false OR 0


    protected function getDataSet() {
        return new PHPUnit_Extensions_Database_DataSet_ArrayDataSet(
                ['student' => [
                ['studentId' => '12020535',
                    'studentName' => 'Ngo Anh Long',
                    'dateOfBirth' => '18/04/1994',
                    'gender' => 1,
                    'phone' => '0166 366 9281',
                    'address' => 'Quang Ninh'
                ],
                ['studentId' => '12020323',
                    'studentName' => 'Ngo Duc Hai',
                    'dateOfBirth' => '10/10/1994',
                    'gender' => 1,
                    'phone' => '0162 834 9289',
                    'address' => 'Bac Giang'
                ],
                ['studentId' => '11343232',
                    'studentName' => 'Do Manh Dat',
                    'dateOfBirth' => '9/6/1994',
                    'gender' => 1,
                    'phone' => '0162 834 0000',
                    'address' => 'Hoa Binh'
                ],
                ['studentId' => '130232732',
                    'studentName' => 'Hoang',
                    'dateOfBirth' => '9/6/1996',
                    'gender' => 1,
                    'phone' => '0162 834 1111',
                    'address' => 'Hai Phong'
                ]
        ]]);
    }

    public function testWhenUserAccessThenExpectedHttpCodeIs200() {
        $this->dispatch('student/profile/create');

        $this->assertResponseCode(200);
        $this->assertAction('create');
        $this->assertModule('student');
        $this->assertController('profile');
    }

    public function testWhenUserAccessThenExpectedPageTitleFollowCustomerIdea() {
        $customerIdea = "create profile";
        $this->dispatch('student/profile/create');

        $this->assertQueryContentContains('title', $customerIdea);
    }

    public function testWhenUserAccessThenExpectedPageHasAFormAndFieldsNeedToFill() {
        $this->dispatch('student/profile/create');

        $this->assertXpath('//form[@name="createProfile"]');
        $this->assertXpath('//input[@type="text"][@name="studentId"]');
        $this->assertXpath('//input[@type="date"][@name="dateOfBirth"]');
        $this->assertXpathCount('//input[@type="radio"][@name="gender"]', 2);
        $this->assertXpath('//input[@type="text"][@name="phone"]');
        $this->assertXpath('//textarea[@row="4"][@cols="5"]');
        $this->assertXpath('//input[@type="submit"]');
    }

    public function testIfUserCreateUserHasAStudentIDExistsThenExpectedPageContentContainsMessageError() {
        $this->getRequest()->setPost(
            ['studentId' => '12020535',
            'studentName' => 'Ngo Anh Long',
            'dateOfBirth' => '18/04/1994',
            'gender' => 1,
            'phone' => '0166 366 9281',
            'address' => 'Quang Ninh'
        ]);
    }

}
