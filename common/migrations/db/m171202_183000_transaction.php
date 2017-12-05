<?php

use common\models\User;
use yii\db\Schema;
use yii\db\Migration;

class m171202_183000_transaction extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%transaction}}', [
            'id' => $this->primaryKey(),
            'sender' => $this->integer(),
            'wallet_from' => $this->string(40)->notNull(),
            'wallet_to' => $this->string(40)->notNull(),
            'receiver' => $this->integer(),
            'type' => $this->smallInteger()->defaultValue(1), // 1 bit, 2 tkc
            'status' => $this->smallInteger()->notNull()->defaultValue(User::STATUS_ACTIVE),
            'created_at' => $this->integer()
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%transaction}}');
    }
}
