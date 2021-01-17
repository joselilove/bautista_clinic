<?php

use Migrations\AbstractMigration;

class CreateMedications extends AbstractMigration
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
            'medications',
            [
                'collation' => 'utf8_general_ci'
            ]
        );
        $table->addColumn(
            'patient_id',
            'integer',
            [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ]
        );
        $table->addColumn(
            'rec_medication',
            'string',
            [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ]
        );
        $table->addColumn(
            'rec_diagnosis',
            'string',
            [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ]
        );
        $table->addColumn(
            'rec_bp',
            'string',
            [
                'default' => null,
                'limit' => 200,
                'null' => true,
            ]
        );
        $table->addColumn(
            'rec_cr',
            'string',
            [
                'default' => null,
                'limit' => 200,
                'null' => true,
            ]
        );
        $table->addColumn(
            'rec_wt',
            'string',
            [
                'default' => null,
                'limit' => 200,
                'null' => true,
            ]
        );
        $table->addColumn(
            'rec_status',
            'string',
            [
                'default' => 'ongoing',
                'limit' => 200,
                'null' => true,
            ]
        );
        $table->addColumn(
            'rec_date',
            'timestamp',
            [
                'default' => null,
                'null' => true,
            ]
        );
        $table->addColumn(
            'rec_complains',
            'string',
            [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ]
        );
        $table->addColumn(
            'rec_rr',
            'string',
            [
                'default' => null,
                'limit' => 200,
                'null' => true,
            ]
        );
        $table->addColumn(
            'rec_qn',
            'integer',
            [
                'default' => null,
                'limit' => 8,
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
                'default' => '0',
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
