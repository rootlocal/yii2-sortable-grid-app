<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m220910_075229_create_book_table extends Migration
{
    /** @var string */
    private string $table = '{{%book}}';


    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'sort_order' => $this->integer()->unsigned()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex('book_status_key', $this->table, 'status');
        $this->createIndex('book_sort_order_key', $this->table, 'sort_order');
        $this->createIndex('book_created_at_key', $this->table, 'created_at');
        $this->createIndex('book_updated_at_key', $this->table, 'updated_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
