<?php

/**
 * test show employee profile
 * @author TranVanHoang <hoangtv@vnext.com.vn>
 */
class ShowEmployeeProfileTest extends Vms_Test_PHPUnit_ControllerWithDatabaseFixturesTestCase {

    protected $truncateFixturesWhenTearDown = false;

    protected function getDataSet() {
        return new PHPUnit_Extensions_Database_DataSet_ArrayDataSet([
            "employee" => [
                [
                    "employeeId" => '32121',
                    'employeeName' => 'Abc axy',
                    'dateOfBirth' => "1932-1-1",
                    "gender" => 1,
                    "facultyId" => 3,
                    "position" => 2,
                    "phone" => '01928323918',
                    'address' => 'hn',
                    'role' => 4
                ]
            ]
        ]);
    }

    /**
     * test if id is'nt passed, page will be redirected to list employee profile
     */
    public function testWhenIdIsNotPassed() {
        $this->dispatch('/employee/profile/show-profile');

        $this->assertResponseCode(302);
    }
    
    /**
     * test if id is not exist in database, page will be redirected
     */
    public function testWhenPassIdIsNotExist(){
        $this->dispatch('/employee/profile/show-profile/id/2121');
        $this->assertResponseCode(302);
    }
    
    /**
     * test show exactly employee profile when profile exist
     */
    public function testWhenPassIdIsExist(){
        $this->dispatch('/employee/profile/show-profile/id/32121');

        $this->assertQueryContentContains('tbody tr td', '32121');
        $this->assertQueryContentContains('tbody tr td', 'Abc axy');
        $this->assertQueryContentContains('tbody tr td', '1932-01-01');
        $this->assertQueryContentContains('tbody tr td', '1');
        $this->assertQueryContentContains('tbody tr td', '3');
        $this->assertQueryContentContains('tbody tr td', '2');
        $this->assertQueryContentContains('tbody tr td', '01928323918');
        $this->assertQueryContentContains('tbody tr td', 'hn');
        $this->assertQueryContentContains('tbody tr td', '4');
    }

}
