<?php

use Phinx\Migration\AbstractMigration;

class Role extends AbstractMigration {

    public function change() {
        $table = $this->table('role', ['id' => false, 'primary_key' => ['roleId']]);
        $table->addColumn('roleId', 'string', ['limit' => 25])
                ->addColumn('roleName', 'string', ['limit' => 50])
                ->create();
    }

}
