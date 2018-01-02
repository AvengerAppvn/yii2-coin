<?php

use yii\db\Schema;
use yii\db\Migration;

class m171202_163000_wallet extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%wallet}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'wallet_btc' => $this->string(100)->notNull(),
            'wallet_eth' => $this->string(100)->notNull(),
            'wallet_coin' => $this->string(100)->notNull(),
            'amount_btc' => $this->float()->defaultValue(0),
            'bonus_btc' => $this->float()->defaultValue(0),
            'amount_eth' => $this->float()->defaultValue(0),
            'bonus_eth' => $this->float()->defaultValue(0),
            'amount_coin' => $this->float()->defaultValue(0),
            'bonus_coin' => $this->float()->defaultValue(0),
            'amount_bonus' => $this->float()->defaultValue(0),
            'amount_ico' => $this->float()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        $this->addForeignKey('fk_wallet_user', '{{%wallet}}', 'user_id', '{{%user}}', 'id', 'cascade', 'cascade');

    }

    public function down()
    {
        $this->dropForeignKey('fk_wallet_user', '{{%wallet}}');
        $this->dropTable('{{%wallet}}');
    }
}
