<?php

use yii\db\Migration;

/**
 * Class m230404_123112_insert
 */
class m230404_123112_insert extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->batchInsert('fulled',['id_u','date','description','amount','attachement'],[
            [1,'01','Minecraft',60,'jaj'],
            [1,'05','rocket',60,'jaaj'],
            [2,'30','league',60,'jaaaaj'],
            [1,'21','of',60,'joaj'],
            [2,'031','legend',60,'jauj'],
            [2,'11','cod',60,'jeaj'],
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230404_123112_insert cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230404_123112_insert cannot be reverted.\n";

        return false;
    }
    */
}
