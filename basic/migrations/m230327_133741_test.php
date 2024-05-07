<?php

use yii\db\Migration;

/**
 * Class m230327_133741_test
 */
class m230327_133741_test extends Migration
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
        echo "m230327_133741_test cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230327_133741_test cannot be reverted.\n";

        return false;
    }
    */
}
