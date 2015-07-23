<?php

use Phinx\Migration\AbstractMigration;

class StudentProfile extends AbstractMigration {

    public function change() {
        $table = $this->table('student');
        $table->addColumn('studentId', 'string', ['limit' => 25])
                ->addColumn('studentName', 'string', ['limit' => 50])
                ->addColumn('dateOfBirth', 'date')
                ->addColumn('gender', 'boolean')
                ->addColumn('phone', 'string', ['limit' => 11])
                ->addColumn('address', 'string', ['limit' => 150])
                ->addIndex(array('studentId'), array('unique' => true))
                ->create();
    }

}
