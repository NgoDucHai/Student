<?php

use Phinx\Migration\AbstractMigration;

class Semester extends AbstractMigration
{
    
    public function change()
    {
        $table = $this->table('semester', ['id' => false, 'primary_key' => ['semesterId']]);
        $table->addColumn('semesterId', 'string', ['limit' => 25])
                ->addColumn('begin','date')
                ->addColumn('end', 'date')
                ->addColumn('price','string')
                ->create();
    }
}
