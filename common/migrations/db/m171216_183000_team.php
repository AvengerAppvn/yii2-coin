<?php

use common\models\User;
use yii\db\Schema;
use yii\db\Migration;

class m171216_183000_team extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%team}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'related_id' => $this->integer(),
            'amount_btc' => $this->float()->notNull(),
            'amount_btc_bonus' => $this->float()->notNull(),
            'amount_eth' => $this->float()->notNull(),
            'amount_eth_bonus' => $this->float()->notNull(),
            'amount_total_bonus' => $this->float()->notNull(),
            'level' => $this->integer(),
            'type' => $this->smallInteger()->defaultValue(1),
            'status' => $this->smallInteger()->notNull()->defaultValue(User::STATUS_ACTIVE),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%team}}');
    }
}
