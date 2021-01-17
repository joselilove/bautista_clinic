<?php

use Migrations\AbstractMigration;

class CreatePatients extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table(
            'patients',
            [
                'collation' => 'utf8_general_ci'
            ]
        );
        $table->addColumn(
            'pat_middle_initial',
            'string',
            [
                'default' => null,
                'limit' => 2,
                'null' => true,
            ]
        );
        $table->addColumn(
            'pat_address',
            'string',
            [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ]
        );
        $table->addColumn(
            'pat_gender',
            'string',
            [
                'default' => null,
                'limit' => 60,
                'null' => true,
            ]
        );
        $table->addColumn(
            'pat_occupation',
            'string',
            [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ]
        );
        $table->addColumn(
            'pat_contact',
            'string',
            [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ]
        );
        $table->addColumn(
            'pat_age',
            'integer',
            [
                'default' => null,
                'limit' => 10,
                'null' => true,
            ]
        );
        $table->addColumn(
            'pat_birthdate',
            'date',
            [
                'default' => null,
                'null' => true,
            ]
        );
        $table->addColumn(
            'pat_fname',
            'string',
            [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ]
        );
        $table->addColumn(
            'pat_lname',
            'string',
            [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ]
        );
        $table->addColumn(
            'user_id',
            'integer',
            [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ]
        );
        $table->addColumn(
            'is_deleted',
            'integer',
            [
                'default' => 0,
                'limit' => 1,
                'null' => false,
            ]
        );
        $table->addColumn(
            'modified',
            'timestamp',
            [
                'default' => 'CURRENT_TIMESTAMP',
                'null' => false,
            ]
        );
        $table->addColumn(
            'created',
            'timestamp',
            [
                'default' => 'CURRENT_TIMESTAMP',
                'null' => false,
            ]
        );
        $table->create();
    }
}
