<?php

use yii\db\Schema;
use yii\db\Migration;

class m171222_123000_notification extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%notification}}', [
            'id' => $this->primaryKey(),
            'notification_id' => $this->string(50),
            'type' => $this->string(50),
            'data' => $this->text(),
            'user_id'=> $this->string(50),
            'account_id'=> $this->string(50),
            'address'=> $this->string(50),
            'currency'=> $this->string(50),
            'amount'=> $this->float(50),
            'transaction_id'=> $this->string(50),
            'delivery_attempts' => $this->integer()->defaultValue(0),
            'delivery_response' => $this->string(50),
            'rawdata' => $this->text(),
            'status' => $this->smallInteger()->defaultValue(0),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%notification}}');
    }
}
