<?php

use common\models\User;
use yii\db\Schema;
use yii\db\Migration;

class m171224_183000_deposit extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%deposit}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'sender' => $this->string(),
            'receiver' => $this->string(),
            'amount' => $this->float(),
            'type' => $this->smallInteger()->defaultValue(1), // 1 bit, 2 tkc
            'status' => $this->smallInteger()->notNull()->defaultValue(User::STATUS_ACTIVE),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%deposit}}');
    }
}
