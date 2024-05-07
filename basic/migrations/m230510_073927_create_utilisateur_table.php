<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%utilisateur}}`.
 */
class m230510_073927_create_utilisateur_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('utilisateur', [
            'id' => $this->primaryKey(),
            'nom' => $this->string()->notNull(),
            'prenom' => $this->string()->notNull(),
            'pseudo' => $this->string()->notNull(),
            'mot_de_passe' => $this->string()->notNull(),
            'autre_table_id' => $this->integer(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // Ajouter une clé étrangère
        $this->addForeignKey('fk_utilisateur_autre_table', 'utilisateur', 'autre_table_id', 'autre_table', 'id', 'CASCADE', 'CASCADE');
        
    }
    

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Supprimer la clé étrangère
        $this->dropForeignKey('fk_utilisateur_autre_table', 'utilisateur');

        $this->dropTable('utilisateur');

    }
}
