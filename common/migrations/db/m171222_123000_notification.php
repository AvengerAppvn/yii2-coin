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
            'notification_id' => $this->string(50)->notNull(),
            'type' => $this->string(50)->notNull(),
            'data' => $this->text(),
            'user_id'=> $this->string(50)->notNull(),
            'account_id'=> $this->string(50)->notNull(),
            'delivery_attempts' => $this->integer()->defaultValue(0),
            'delivery_response' => $this->string(50),
            'rawdata' => $this->text(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%notification}}');
    }
}
