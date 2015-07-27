<?php

/**
 * @author Tran Van Hoang
 * test index student page when having data.
 */
class IndexStudentProfilePageIntergrateDbTest extends Vms_Test_PHPUnit_ControllerWithDatabaseFixturesTestCase {

    protected $truncateFixturesWhenTearDown = false;

    /**
     * initializing data to test index student profile page
     */
    protected function getDataSet() {
        return new PHPUnit_Extensions_Database_DataSet_ArrayDataSet([
            "student" => [
                [
                    "studentId" => 'h1h1h1h1h1hh1h1h1h1',
                    "studentName" => "Tran Van Hoang",
                    "dateOfBirth" => '1996-01-21',
                    "gender" => true,
                    "phone" => '01267618465',
                    "address" => 'Tran Nguyen Han, Le Chan, Hai Phong'
                ],
                [
                    "studentId" => 'h1h1h1h1h1hh1h1h1h2',
                    "studentName" => "Nguyen Du",
                    "dateOfBirth" => '1996-05-03',
                    "gender" => true,
                    "phone" => '0168686868',
                    "address" => 'Kien An, Hai Phong'
                ],
                [
                    "studentId" => 'h1h1h1h1h1hh1h1h1h3',
                    "studentName" => "Vu Dai Duong",
                    "dateOfBirth" => '1996-06-19',
                    "gender" => true,
                    "phone" => '01686868688',
                    "address" => 'Kien An, Hai Phong'
                ]
            ]
        ]);
    }

    /**
     * test access to index student page is ok and return http code 200
     */
    public function testAccessToIndexStudentPageWillReturnHttpCode200() {
        $this->dispatch('student/profile/index');
        $this->assertResponseCode(200);
        $this->assertModule('student');
        $this->assertController('profile');
        $this->assertAction('index');
    }

    /**
     * test index student profile page display title of each field
     */
    public function testIndexStudentProfilePageDisplayTitleTable() {
        $this->dispatch('student/profile/index');

        $this->assertQueryContentContains('table thead tr th', 'Mã sinh viên');
        $this->assertQueryContentContains('table thead tr th', 'Họ và tên');
        $this->assertQueryContentContains('table thead tr th', 'Ngày sinh');
        $this->assertQueryContentContains('table thead tr th', 'Giới tính');
        $this->assertQueryContentContains('table thead tr th', 'Số điện thoại');
        $this->assertQueryContentContains('table thead tr th', 'Địa chỉ');
    }

    /**
     * test index student profile page display exactly 3 records prepared
     * @dataProvider prepare3RecordsOfStudentToTest
     */
    public function testIndexStudentProfilePageDisplayExactlyExactly3Records($studentId, $studentName, $studentBirthOfDay, $studentGender, $studentPhone, $studentAddress) {
        $this->dispatch('student/profile/index');

        $this->assertQueryContentContains('table tbody tr td', $studentId);
        $this->assertQueryContentContains('table tbody tr td', $studentName);
        $this->assertQueryContentContains('table tbody tr td', $studentBirthOfDay);
        $this->assertQueryContentContains('table tbody tr td', $studentGender);
        $this->assertQueryContentContains('table tbody tr td', $studentPhone);
        $this->assertQueryContentContains('table tbody tr td', $studentAddress);
    }

    /**
     * initializing 3 records to test 
     */
    public function prepare3RecordsOfStudentToTest() {
        return [
            ['h1h1h1h1h1hh1h1h1h1', "Tran Van Hoang", '1996-01-21', 'nam', '01267618465', 'Tran Nguyen Han, Le Chan, Hai Phong'],
            ['h1h1h1h1h1hh1h1h1h2', 'Nguyen Du', '1996-05-03', 'nam', '0168686868', 'Kien An, Hai Phong'],
            ['h1h1h1h1h1hh1h1h1h3', 'Vu Dai Duong', '1996-06-19', 'nam', '01686868688', 'Kien An, Hai Phong']
        ];
    }
    
    /**
     * test paginator on index student page when only page param
     * @dataProvider prepare3RecordsOfStudentToTest
     */
    public function testPaginatorOnIndexStudentPage($studentId, $studentName, $studentBirthOfDay, $studentGender, $studentPhone, $studentAddress){
        $this->dispatch('student/profile/index/page/1');

        $this->assertQueryContentContains('table tbody tr td', $studentId);
        $this->assertQueryContentContains('table tbody tr td', $studentName);
        $this->assertQueryContentContains('table tbody tr td', $studentBirthOfDay);
        $this->assertQueryContentContains('table tbody tr td', $studentGender);
        $this->assertQueryContentContains('table tbody tr td', $studentPhone);
        $this->assertQueryContentContains('table tbody tr td', $studentAddress);
    }
    
    /**
     * test index student page can be changed item per page.
     * In this case, i test page =1 and size =1
     */
    public function testIndexStudentPageCanBeChangedItemPerPage(){
        $this->dispatch('student/profile/index/size/1/page/1');
        
        $this->assertQueryContentContains('table tbody tr td', 'h1h1h1h1h1hh1h1h1h1');
        $this->assertQueryContentContains('table tbody tr td', 'Tran Van Hoang');
        $this->assertQueryContentContains('table tbody tr td', '1996-01-21');
        $this->assertQueryContentContains('table tbody tr td', 'nam');
        $this->assertQueryContentContains('table tbody tr td', '01267618465');
        $this->assertQueryContentContains('table tbody tr td', 'Tran Nguyen Han, Le Chan, Hai Phong');
    }

}
