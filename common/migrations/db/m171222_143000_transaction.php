<?php

use yii\db\Schema;
use yii\db\Migration;

class m171222_143000_transaction extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%transaction}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(),
            'status' => $this->string(),
            'description' => $this->string(),
            'fee' => $this->string(),
            'instantExchange' => $this->boolean(),

            'network_status' => $this->string(),
            'network_hash' => $this->string(),
            
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%transaction}}');
    }
}
