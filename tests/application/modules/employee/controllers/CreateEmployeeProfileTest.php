<?php

/**
 * @author domanhdat
 */
class CreateEmployeeProfileTest extends Vms_Test_PHPUnit_ControllerWithDatabaseFixturesTestCase {

    protected $truncateFixturesWhenTearDown = true;

    protected function getDataSet() {
        return new PHPUnit_Extensions_Database_DataSet_ArrayDataSet([
            'student' => [
                ['studentId' => '12020535',
                    'studentName' => 'Ngo Anh Long',
                    'dateOfBirth' => '1994/04/18',
                    'gender' => 1,
                    'phone' => '01663669281',
                    'address' => 'Quang Ninh'
                ]
            ]
        ]);
    }

}
