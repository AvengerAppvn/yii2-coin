<?php

use common\models\User;
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
            'user_id' => $this->integer()->primaryKey(),
            'wallet_btc' => $this->string(40)->notNull(),
            'wallet_eth' => $this->string(40)->notNull(),
            'wallet_coin' => $this->string(40)->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(User::STATUS_ACTIVE),
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
