<?php

use Phinx\Migration\AbstractMigration;

class StudentProfile extends AbstractMigration {

    public function change() {

        $exists = $this->hasTable('student');
        if ($exists) {
            $this->dropTable('student');
        }

        $table = $this->table('student', ['id' => false]);
        $table
                ->addColumn('studentName', 'string', ['limit' => 50])
                ->addColumn('dateOfBirth', 'date')
                ->addColumn('gender', 'boolean')
                ->addColumn('phone', 'integer', ['limit' => 11])
                ->addColumn('address', 'string', ['limit' => 150])
                ->create();

        //addColumn('studentId', 'string', ['limit' => 25])
        $this->execute("ALTER TABLE student ADD COLUMN studentId varchar(25) PRIMARY KEY;");
    }

}
