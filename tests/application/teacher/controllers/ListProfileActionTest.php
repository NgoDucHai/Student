<?php

/**
 * Description of ListProfileActionTest
 *
 * @author domanhdat
 */
class ListProfileActionTest extends Vms_Test_PHPUnit_ControllerWithDatabaseFixturesTestCase {

    protected $truncateFixturesWhenTearDown = true;

    protected function getDataSet() {
        return new PHPUnit_Extensions_Database_DataSet_ArrayDataSet([
            "teacher" => [
                [
                    "teacherId" => '1125467',
                    "teacherName" => 'teacher1',
                    "dateOfBirth" => '1984-12-02',
                    "gender" => '0',
                    "diploma" => '1',
                    "phone" => '123476543',
                    "address" => 'ha noi',
                    "rule" => '1',
                    "avatar" => '',
                ],
                [
                    "teacherId" => '1125465',
                    "teacherName" => 'teacher2',
                    "dateOfBirth" => '1984-01-02',
                    "gender" => '0',
                    "diploma" => '1',
                    "phone" => '1234756443',
                    "address" => 'hoa binh',
                    "rule" => '1',
                    "avatar" => '',
                ]
            ]
        ]);
    }
    public function testWhenAccessPageListProfileTeacherThenReturnHttpCode200(){
        $this->dispatch('/teacher/profile/list-profile');
        
        $this->assertResponseCode(200);
    }
    
    public function testWhenAccessPageListProfileTeacherThenDisplayTitle(){
        $this->dispatch('/teacher/profile/list-profile');
        
        $this->assertQueryContentContains('title', 'List profile teacher');
    }
    
    public function testWhenAccessPageListProfileTeacherThenDisplayTable(){
        $this->dispatch('/teacher/profile/list-profile');
        
        $this->assertQueryContentContains('thead', 'Stt');
        $this->assertQueryContentContains('thead', 'Mã giáo viên');
        $this->assertQueryContentContains('thead', 'Tên giáo viên');
        $this->assertQueryContentContains('thead', 'Ngày sinh');
        $this->assertQueryContentContains('thead', 'Giới tính');
        $this->assertQueryContentContains('thead', 'Trình độ');
        $this->assertQueryContentContains('thead', 'Số điện thoại');
        $this->assertQueryContentContains('thead', 'Địa chỉ');
        $this->assertQueryContentContains('thead', 'Ảnh đại diện');
    }
}
