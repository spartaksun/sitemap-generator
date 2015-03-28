<?php

use yii\db\Migration;

class m150328_115146_create_table_task extends Migration
{
    public function up()
    {
        $this->createTable('task', [
            'id'            => 'pk',
            'storage_key'   => 'varchar(32) NOT NULL',
            'start_url'     => 'varchar(255) NOT NULL',
            'amount'        => 'int DEFAULT 0 NOT NULL',
            'nesting_level' => 'int DEFAULT 0 NOT NULL',
            'status'        => 'int DEFAULT 0 NOT NULL',
            'created_at'    => 'int DEFAULT 0 NOT NULL',
            'updated_at'    => 'int DEFAULT 0 NOT NULL',
        ], 'Engine=InnoDB DEFAULT CHARSET=utf8;');

        $this->createIndex('idx__storage_key', 'task', 'storage_key', true);
    }

    public function down()
    {
        $this->dropTable('task');
    }
}
