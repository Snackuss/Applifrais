<?php

use yii\db\Migration;

/**
 * Class m230327_133837_test2
 */
class m230327_133837_test2 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->insert('user', [
            'nom'=>'test2',
            'passwd'=>'test'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230327_133837_test2 cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230327_133837_test2 cannot be reverted.\n";

        return false;
    }
    */
}
