<?php

use Phinx\Migration\AbstractMigration;

class Position extends AbstractMigration {

   
    public function change() {
        $table = $this->table('position', ['id' => false, 'primary_key' => ['positionId']]);
        $table->addColumn('positionId', 'string', ['limit' => 25])
                ->addColumn('roleName', 'string', ['limit' => 50])
                ->create();
    }

}
