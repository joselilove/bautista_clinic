<?php

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
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
            'users',
            [
                'collation' => 'utf8_general_ci'
            ]
        );
        $table->addColumn(
            'name',
            'string',
            [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ]
        );
        $table->addColumn(
            'username',
            'string',
            [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ]
        );
        $table->addColumn(
            'password',
            'string',
            [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ]
        );
        $table->addColumn(
            'emp_type',
            'string',
            [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ]
        );
        $table->addColumn(
            'email',
            'string',
            [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ]
        );
        $table->addColumn(
            'activated',
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
