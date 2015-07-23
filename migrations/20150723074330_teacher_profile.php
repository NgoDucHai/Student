<?php

use Phinx\Migration\AbstractMigration;

class TeacherProfile extends AbstractMigration {

    public function change() {
        $table = $this->table('teacher', ['id' => false, 'primary_key' => ['teacherId']]);
        $table->addColumn('teacherId', 'string', ['limit' => 25])
                ->addColumn('teacherName', 'string', ['limit' => 50])
                ->addColumn('dateOfBirth', 'date')
                ->addColumn('gender', 'boolean')
                ->addColumn('diploma', 'string', ['limit' => 100])
                ->addColumn('phone', 'string', ['limit' => 15])
                ->addColumn('address', 'string', ['limit' => 150])
                ->addColumn('rule', 'integer', ['limit' => 5])
                ->create();
    }

}
