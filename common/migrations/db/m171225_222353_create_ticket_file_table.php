<?php

use yii\db\Migration;

/**
 * Handles the creation for table `ticket_file_table`.
 */
class m171225_222353_create_ticket_file_table extends Migration
{

    private $table = '{{%ticket_file}}';
    private $ticket_body = '{{%ticket_body}}';
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'id_body' => $this->integer()->notNull(),
            'path' => $this->string()->notNull(),
            'base_url' => $this->string(),
            'type' => $this->string(),
            'size' => $this->integer(),
            'name' => $this->string(),
            'created_at' => $this->integer(),
            'order' => $this->integer()
        ], $tableOptions);

        $this->createIndex('i_id_body', $this->table, 'id_body');
        $this->addForeignKey('fk_id_body', $this->table, 'id_body', $this->ticket_body, 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_id_body', $this->table);
        $this->dropTable($this->table);
    }
}
