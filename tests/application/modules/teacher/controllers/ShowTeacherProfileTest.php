<?php

class ShowTeacherProfileTest extends Vms_Test_PHPUnit_ControllerWithDatabaseFixturesTestCase {

    protected $truncateFixturesWhenTearDown = false;

    protected function getDataSet() {
        return new PHPUnit_Extensions_Database_DataSet_ArrayDataSet([
            "teacher" => [
                [
                    "teacherId" => '1',
                    'teacherName' => 'Ngo Duc Hai',
                    'dateOfBirth' => "1994-03-06",
                    "gender" => 1,
                    'diploma' => 'Master',
                    "phone" => '01659338885',
                    "address" => "Tan Yen- Bac Giang",
                    'rule' => '1',
                    'avatar' => 'no avata'
                ],
                [
                    "teacherId" => '12020535',
                    'teacherName' => 'Ngo Anh Long',
                    'dateOfBirth' => "1994-04-18",
                    "gender" => 1,
                    'diploma' => 'Master',
                    "phone" => '01659338885',
                    "address" => "Quang Ninh",
                    'rule' => '1',
                    'avatar' => 'no avata'
                ],
            ]
        ]);
    }

    public function testWhenUserAccessThenExpectedCodeIs200() {
        $this->dispatch('/teacher/profile/show-profile');
        $this->assertAction('show-profile');
        $this->assertController('profile');
        $this->assertModule('teacher');
    }

    public function testWhenUserAccessThenExpectedTitlePageFollowIdeaOfCustomer() {
        $this->dispatch('/teacher/profile/show-profile/id/12020535');

        $this->assertQueryContentContains('title', 'show profile of teacher');
    }

    public function testWhenUserDispatchUrlWithoutIdThenRedirectThemToListProfile() {
        $this->dispatch('/teacher/profile/show-profile/');
        $this->assertRedirectTo('/teacher/profile/list-profile');
    }

    public function testWhenUserDispatchCorrectUrlThenExpectedACorrespondingProfileWillDisplay() {
        $this->dispatch('/teacher/profile/show-profile/id/12020535');

        $this->assertQueryContentContains('h1', 'Profile of teacher');
        
        $this->assertQueryContentContains('td', 'Teacher ID');
        $this->assertQueryContentContains('td', 'Teacher Name');
        $this->assertQueryContentContains('td', 'Date of Birth');
        $this->assertQueryContentContains('td', 'Diploma');
        $this->assertQueryContentContains('td', 'Gender');
        $this->assertQueryContentContains('td', 'Phone');
        $this->assertQueryContentContains('td', 'Rule');
        $this->assertQueryContentContains('td', 'Address');
        
        $this->assertQueryContentContains('td', '12020535');
        $this->assertQueryContentContains('td', 'Ngo Anh Long');
        $this->assertQueryContentContains('td', 'Quang Ninh');
        $this->assertQueryContentContains('td', '1994-04-18');
        $this->assertQueryContentContains('td', 'Master');
        $this->assertQueryContentContains('td', '01659338885');
        $this->assertQueryContentContains('td', '1');
        $this->assertQueryContentContains('td', '1');
        
    }
    
    public function testWhenUserDispatchNotExistsIdThenDisplayErrorMessage()
    {
        $this->dispatch('/teacher/profile/show-profile/id/120202323');
        
        $this->assertQueryContentContains('h2', 'Profile not found');
    }
    
}
