<?php

use yii\db\Migration;



class m210515_123456_create_frais_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%frais}}', [
            'id' => $this->primaryKey(),
            'description' => $this->string()->notNull(),
            'amount' => $this->decimal(10, 2)->notNull(),
            'date' => $this->date()->notNull(),
            // Ajoutez les colonnes supplémentaires que vous souhaitez pour la table des frais
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%frais}}');
    }
}

