<?php

use common\models\User;
use yii\db\Schema;
use yii\db\Migration;

class m171202_123000_referer extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%referer}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(32),
            'user_id' => $this->integer()->notNull(),
            'node' => $this->integer(),
            'level' => $this->integer()->defaultValue(1),
            'status' => $this->smallInteger()->notNull()->defaultValue(User::STATUS_ACTIVE),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'logged_at' => $this->integer()
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%referer}}');
    }
}
