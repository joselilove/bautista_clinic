<?php

use Migrations\AbstractMigration;

class UpdateSessionsId extends AbstractMigration
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
        $table->changeColumn(
            'id',
            'string',
            [
                'default' => null,
                'limit' => 40,
                'null' => false,
                'encoding' => 'ascii',
                'collation' => 'ascii_bin',
            ]
        )->save();
    }
}
