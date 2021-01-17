<?php

use Migrations\AbstractMigration;

class CreateSessions extends AbstractMigration
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
        $table = $this->table('sessions');
        $table->addColumn(
            'created',
            'datetime',
            [
                'default' => 'CURRENT_TIMESTAMP',
                'null' => true,
            ]
        );
        $table->addColumn(
            'modified',
            'datetime',
            [
                'default' => 'CURRENT_TIMESTAMP',
                'null' => true,
            ]
        );
        $table->addColumn(
            'data',
            'blob',
            [
                'default' => null,
                'null' => true,
            ]
        );
        $table->addColumn(
            'expires',
            'integer',
            [
                'default' => null,
                'limit' => 10,
                'null' => true,
            ]
        );
        $table->create();
    }
}
