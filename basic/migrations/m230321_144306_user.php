<?php

use yii\db\Migration;

/**
 * Class m230321_144306_user
 */
class m230321_144306_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->insert('user', [
            'nom'=>'test',
            'passwd'=>'test'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230321_144306_user cannot be reverted.\n";

        return false;
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230321_144306_user cannot be reverted.\n";

        return false;
    }
    */
    
}
