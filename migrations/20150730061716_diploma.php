<?php

use Phinx\Migration\AbstractMigration;

class Diploma extends AbstractMigration
{
  
    public function change()
    {
        $table = $this->table('diploma', ['id' => false, 'primary_key' => ['diplomaId']]);
        $table->addColumn('diplomaId', 'string', ['limit' => 25])
                ->addColumn('acronym','string',['limit' => 25])
                ->addColumn('name', 'string', ['limit' => 50])
                ->create();
    }
}
