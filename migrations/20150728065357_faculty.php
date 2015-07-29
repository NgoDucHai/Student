<?php

use Phinx\Migration\AbstractMigration;

class Faculty extends AbstractMigration {

    public function change() {
        $table = $this->table('faculty', ['id' => false, 'primary_key' => ['facultyId']]);
        $table->addColumn('facultyId', 'string', ['limit' => 25])
                ->addColumn('facultyName', 'string', ['limit' => 50])
                ->create();
    }

}
