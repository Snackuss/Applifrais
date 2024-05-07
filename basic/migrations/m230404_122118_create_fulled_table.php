<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fulled}}`.
 */
class m230404_122118_create_fulled_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%fulled}}', [
            'id' => $this->primaryKey(),
            'id_u'=> $this->integer()->notNUll(),
            'date'=> $this->integer()->defaultValue(1),
            'description'=> $this->string(),
            'amount'=> $this->integer(),
            'attachement'=> $this->string(),
        ]);

        $this->createIndex(
            'idx-fulled-id_u',
            'fulled',
            'id_u',
        );

        $this->addForeignKey(
            'fk-fulled-id_u',
            'fulled',
            'id_u',
            'user',
            'id',
            'CASCADE'
        );

        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%fulled}}');
    }
}