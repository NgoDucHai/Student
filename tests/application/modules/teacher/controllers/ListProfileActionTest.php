<?php

/**
 * Description of ListProfileActionTest
 *
 * @author domanhdat
 */
class ListProfileActionTest extends Vms_Test_PHPUnit_ControllerWithDatabaseFixturesTestCase {

    protected $truncateFixturesWhenTearDown = true;

    protected function getDataSet() {

        $data = [];
        for ($i = 1; $i < 10; $i++) {
            $data['teacherId'] = '1122345' . $i;
            $data['teacherName'] = 'teacher' . $i;
            $data['dateOfBirth'] = '1984-12-0' . $i;
            $data['gender'] = $i % 2;
            $data['diploma'] = 1;
            $data['phone'] = '123476543' . $i;
            $data['address'] = 'hoa binh ' . $i;
            $data['role'] = 1;
            $data['avatar'] = '';

            $arr[] = $data;
        }
        return new PHPUnit_Extensions_Database_DataSet_ArrayDataSet([
            "teacher" => $arr
        ]);
    }

    public function testWhenAccessPageListProfileTeacherThenReturnHttpCode200() {
        $this->dispatch('/teacher/profile/list-profile');

        $this->assertResponseCode(200);
    }

    public function testWhenAccessPageListProfileTeacherThenDisplayTitle() {
        $this->dispatch('/teacher/profile/list-profile');

        $this->assertQueryContentContains('title', 'List profile teacher');
    }

    public function testWhenAccessPageListProfileTeacherThenDisplayTable() {
        $this->dispatch('/teacher/profile/list-profile');

        $this->assertQueryContentContains('th', 'Stt');
        $this->assertQueryContentContains('th', 'Mã giáo viên');
        $this->assertQueryContentContains('th', 'Tên giáo viên');
        $this->assertQueryContentContains('th', 'Ngày sinh');
        $this->assertQueryContentContains('th', 'Giới tính');
        $this->assertQueryContentContains('th', 'Trình độ');
        $this->assertQueryContentContains('th', 'Số điện thoại');
        $this->assertQueryContentContains('th', 'Địa chỉ');
        $this->assertQueryContentContains('th', 'Ảnh đại diện');
    }

    public function testWhenAccessPageListProfileTeacherThenDisplayActorEditAndDelete() {
        $this->dispatch('/teacher/profile/list-profile');

        $this->assertQueryContentContains('th', 'Hành động');
    }

    public function testWhenAccessPageListProfileTeacherThenDisplayInformationOfTeacher() {
        $this->dispatch('/teacher/profile/list-profile');

//        $this->assertQuery('tbody');
//        $this->assertQuery('td');

        for ($i = 1; $i < 2; $i++) {
            $gender = $i % 2;
            $this->assertQueryContentContains('td', "{$i}");
            $this->assertQueryContentContains('td', "1122345{$i}");
            $this->assertQueryContentContains('td', "teacher{$i}");
            $this->assertQueryContentContains('td', "1984-12-0{$i}");
            $this->assertQueryContentContains('td', "{$gender}");
            $this->assertQueryContentContains('td', "1");
            $this->assertQueryContentContains('td', "123476543{$i}");
            $this->assertQueryContentContains('td', "hoa binh {$i}");
//            $this->assertQueryContentContains('td', '');
        }
    }

    public function testWhenAccessPageListProfileTeacherThenDisplay() {
        
    }

}
