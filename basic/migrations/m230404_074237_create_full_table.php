<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news}}`.
 */
class m230404_074237_create_full_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%full}}', [
            'id' => $this->primaryKey(),
            'id_u'=> $this->integer()->notNull(),
            'date'=> $this->integer()->defaultValue(1),
            'description'=> $this->string(),
            'amount'=> $this->integer(),
            'attachement'=> $this->string(),
        ]);

        $this->createIndex(
            'idx-full-id_u',
            'full',
            'id_u',
        );

        $this->addForeignKey(
            'fk-full-id_u',
            'full',
            'id_u',
            'users',
            'id',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%full}}');
    }
}
