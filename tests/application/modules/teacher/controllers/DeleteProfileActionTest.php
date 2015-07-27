<?php

/**
 *
 * @author domanhdat
 */
class DeleteProfileActionTest extends Vms_Test_PHPUnit_ControllerWithDatabaseFixturesTestCase {

    protected $truncateFixturesWhenTearDown = false;

    protected function getDataSet() {

        $data = [];
        for ($i = 1; $i < 3; $i++) {
            $data['teacherId'] = '1122345' . $i;
            $data['teacherName'] = 'teacher' . $i;
            $data['dateOfBirth'] = '1984-12-0' . $i;
            $data['gender'] = $i % 2;
            $data['diploma'] = 1;
            $data['phone'] = '123476543' . $i;
            $data['address'] = 'hoa binh ' . $i;
            $data['rule'] = 1;
            $data['avatar'] = '';

            $arr[] = $data;
        }
        return new PHPUnit_Extensions_Database_DataSet_ArrayDataSet([
            "teacher" => $arr
        ]);
    }

    public function testWhenPostIdNullThenRediectorListProfile() {
        $this->dispatch('/teacher/profile/delete-profile');

        $this->assertRedirectTo('/teacher/profile/list-profile');
    }

    public function testWhenPostIdIsNotANumberThenRediectorListProfile() {
        $this->dispatch('/teacher/profile/delete-profile/id/haha');

        $this->assertRedirectTo('/teacher/profile/list-profile');
    }

    public function testWhenPostIdNotFoundOnDbThenRedirectorListProfile() {
        $this->dispatch('/teacher/profile/delete-profile/id/12');

        $this->assertRedirectTo('/teacher/profile/list-profile');
    }

    public function testWhenPostIdHasOnDbThenDeleteAndREdirector() {
        $this->dispatch('/teacher/profile/delete-profile/id/11223451');

        $this->assertRedirectTo('/teacher/profile/list-profile');
    }

}
