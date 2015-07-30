<?php

use Phinx\Migration\AbstractMigration;

class SubjectFaculty extends AbstractMigration {

    
    /**
     * @author Ngo Anh Long <ngoanhlong@gmail.com>
     * 
     *  Create table subjectFaculty(Monhoc_Khoa) contains 6 columns
     * 2 primary keys:  subjectId(Ma mon hoc), facultyId(ma khoa)
     * 4 normal columns:  subjectName(Ten mon hoc), numberOfUnit(so tin chi), semesterId(maHocKi), priceOfUnit(gia 1 tinchi)
     */
    public function change() {
        $table = $this->table('subject', ['id' => false, 'primary_key' => ['subjectId', 'facultyId']]);
        $table->addColumn('subjectId', 'string', ['limit' => 25])
                ->addColumn('facultyId', 'string', ['limit' => 25])
                ->addColumn('subjectName', 'string', ['limit' => 50])
                ->addColumn('numberOfUnit', 'integer', ['limit' => 2])
                ->addColumn('semesterId', 'string', ['limit' => 25])
                ->addColumn('priceOfUnit', 'float', ['limit' => 25])
                ->create();
    }

}
