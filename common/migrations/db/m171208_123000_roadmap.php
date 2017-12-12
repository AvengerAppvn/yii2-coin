<?php

use common\models\User;
use yii\db\Schema;
use yii\db\Migration;

// php console/yii migrate/to m171208_123000_roadmap
class m171208_123000_roadmap extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%roadmap}}', [
            'id' => $this->primaryKey(),
            'level' => $this->integer()->notNull(),
            'price' => $this->float()->notNull(),
            'amount' => $this->integer()->notNull(),
            'date_from' => $this->date()->notNull(),
            'date_to' => $this->date()->notNull(),
            'time_from' => $this->time()->notNull(),
            'time_to' => $this->time()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%roadmap}}');
    }
}
