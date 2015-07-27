<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProfileListPageIntergrateDbTest
 *
 * @author haingo
 */
class ShowProfileActionTest extends Vms_Test_PHPUnit_ControllerWithDatabaseFixturesTestCase {

    protected $truncateFixturesWhenTearDown = false;

    protected function getDataSet() {
        return new PHPUnit_Extensions_Database_DataSet_ArrayDataSet([
            "student" => [
                [
                    "studentId" => 1,
                    'studentName' => 'Ngo Duc Hai',
                    'dateOfBirth' => "1994-03-06",
                    "gender" => 1,
                    "phone" => 01659338885,
                    "address" => "Tan Yen- Bac Giang"
                ]
            ]
        ]);
    }

    public function testReturnCode200WhenRequestSuccess() {
        $this->dispatch('student/profile/show');
        $this->assertResponseCode(200);
    }

    public function testCallWithoutActionShouldPullFromIndexActionDefault() {
        $this->dispatch('student/profile/show');
        $this->assertModule('student');
        $this->assertController('profile');
        $this->assertAction('show');
    }

    public function testDisplayTitle() {
        $this->request->setMethod("GET")
                ->setPost([
                    'id' => 1
        ]);
        $this->dispatch('student/profile/show');
        $this->assertQueryContentContains('title', 'Show Profile');
    }

    public function testDisplayFormWithIdShowProfile() {

        $this->dispatch('student/profile/show');
        $this->assertXpath('//form[@id="showprofile"]');
    }

    public function testIfNotDisplayInformationThenReturnMessanger() {
        $this->dispatch('student/profile/show');
        $this->assertQueryContentContains('dl > dt', 'studentId', "Không hiển thị mã số sinh viên");
        $this->assertQueryContentContains('dl > dt', 'studentName', "Không hiển thị họ tên");
        $this->assertQueryContentContains('dl > dt', 'dateOfBirth', "Không hiển thị ngày sinh");
        $this->assertQueryContentContains('dl > dt', 'gender', "Không hiển thị giới tính");
        $this->assertQueryContentContains('dl > dt', 'phone', "Không hiển thị số điện thoại");
        $this->assertQueryContentContains('dl > dt', 'address', "Không hiển thị địa chỉ");
    }

    public function testDisplayFromDb() {
        //$student = $this->getDataSet();/*@var $student PHPUnit_Extensions_Database_DataSet_ArrayDataSet*/
        $student = [
            "studentId" => 1,
            "studentName" => "Ngo Duc Hai",
            "dateOfBirth" => "1994-03-06",
            "gender" => 1,
            "phone" => "01659338885",
            "address" => "Tan Yen- Bac Giang"
        ];

        $this->dispatch('student/profile/show/id/1');
        $this->assertQueryContentContains('dl > dd', $student['studentId'], "Không hiển thị mã số sinh viên");
        $this->assertQueryContentContains('dl > dd', $student['studentName'], "Không hiển thị họ tên");
        $this->assertQueryContentContains('dl > dd', $student['dateOfBirth'], "Không hiển thị ngày sinh");
        $this->assertQueryContentContains('dl > dd', $student['gender'], "Không hiển thị giới tính");
        $this->assertQueryContentContains('dl > dd', $student['phone'], "Không hiển thị số điện thoại");
        $this->assertQueryContentContains('dl > dd', $student['address'], "Không hiển thị địa chỉ");
    }

}
