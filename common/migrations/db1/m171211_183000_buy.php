<?php

use common\models\User;
use yii\db\Schema;
use yii\db\Migration;

class m171211_183000_buy extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%buy}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'amount_coin' => $this->float()->notNull(),
            'amount' => $this->float()->notNull(),
            'token' => $this->string(10)->notNull(),
            'type' => $this->smallInteger()->defaultValue(1), // 1 bit, 2 eth
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%buy}}');
    }
}
