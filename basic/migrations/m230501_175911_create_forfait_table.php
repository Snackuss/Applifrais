<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%forfait}}`.
 */
class m230501_175911_create_forfait_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%forfait}}');
    }
}
