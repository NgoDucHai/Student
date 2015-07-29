<?php

use Phinx\Migration\AbstractMigration;

class FacultyEmployeeProfile extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('employee', ['id' => false, 'primary_key' => ['employeeId']]);
        $table->addColumn('employeeId', 'string', ['limit' => 25])
                ->addColumn('employeeName', 'string', ['limit' => 50])
                ->addColumn('dateOfBirth', 'date')
                ->addColumn('gender', 'boolean')
                ->addColumn('facultyId','string')
                ->addColumn('position','integer',['limit'=>5])
                ->addColumn('phone', 'string', ['limit' => 15])
                ->addColumn('address', 'string', ['limit' => 150])
                ->addColumn('role', 'integer', ['limit' => 5])
                ->addColumn('avatar', 'string')
                ->create();
    }
}
