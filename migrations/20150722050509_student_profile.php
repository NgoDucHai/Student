<?php

use Phinx\Migration\AbstractMigration;

class StudentProfile extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function change()
    {
        $table = $this->table('student');
        $table->addColumn('studentId' ,'string', ['limit'=>25])
                ->addColumn('studentName', 'string', ['limit' => 50])
                ->addColumn('dateOfBirth', 'date')
            ->addColumn('gender','boolean')
            ->addColumn('phone', 'integer', ['limit' => 11])
            ->addColumn('address','string', ['limit'=>150])
            ->create();
                
    }
}
