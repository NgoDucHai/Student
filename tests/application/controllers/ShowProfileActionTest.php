<?php

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
        $this->dispatch('student/profile/show/id/1');

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

    public function testIfNotDisplayInformationThenReturnMessanger() {
        $this->dispatch('student/profile/show/id/1');
        $this->assertQueryContentContains('table > tbody > tr > td', 'Mã sinh viên:', "Không hiển thị mã số sinh viên");
        $this->assertQueryContentContains('table > tbody > tr > td', 'Họ và tên:', "Không hiển thị họ tên");
        $this->assertQueryContentContains('table > tbody > tr > td', 'Ngày sinh:', "Không hiển thị ngày sinh");
        $this->assertQueryContentContains('table > tbody > tr > td', 'Giới tính:', "Không hiển thị giới tính");
        $this->assertQueryContentContains('table > tbody > tr > td', 'Số điện thoại:', "Không hiển thị số điện thoại");
        $this->assertQueryContentContains('table > tbody > tr > td', 'Địa chỉ:', "Không hiển thị địa chỉ");
    }

    public function testDisplayFromDb() {
        $this->dispatch('student/profile/show/id/1');
        $this->assertQueryContentContains('table > tbody > tr > td', 1, "Không hiển thị mã số sinh viên");
        $this->assertQueryContentContains('table > tbody > tr > td', "Ngo Duc Hai", "Không hiển thị họ tên");
        $this->assertQueryContentContains('table > tbody > tr > td', "1994-03-06", "Không hiển thị ngày sinh");
        $this->assertQueryContentContains('table > tbody > tr > td', 1, "Không hiển thị giới tính");
        $this->assertQueryContentContains('table > tbody > tr > td', 01659338885, "Không hiển thị số điện thoại");
        $this->assertQueryContentContains('table > tbody > tr > td', "Tan Yen- Bac Giang", "Không hiển thị địa chỉ");
    }

}
