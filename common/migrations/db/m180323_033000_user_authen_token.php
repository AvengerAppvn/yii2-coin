<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Class m180323_033000_user_kid
 */
class m180323_033000_user_authen_token extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'access_token_expired_at', Schema::TYPE_TIMESTAMP. ' NULL DEFAULT NULL');
        $this->addColumn('user', 'last_login_at', Schema::TYPE_TIMESTAMP. ' NULL DEFAULT NULL');
        $this->addColumn('user', 'last_login_ip', $this->string(20));
        $this->addColumn('user', 'registration_ip', $this->string(20));
        $this->addColumn('user', 'role', $this->integer(11)->null());
        //ALTER TABLE `user` CHANGE `kid_name` `kid_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `kid_avatar` `kid_avatar` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'access_token_expired_at');
        $this->dropColumn('user', 'last_login_at');
        $this->dropColumn('user', 'last_login_ip');
        $this->dropColumn('user', 'registration_ip');
        $this->dropColumn('user', 'role');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180323_033000_user_kid cannot be reverted.\n";

        return false;
    }
    */
}
