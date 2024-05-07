<?php

namespace app\models;

use yii\db\ActiveRecord;

class Frais extends ActiveRecord
{
    public static function tableName()
    {
        return 'frais';
    }

    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [


            'type' => 'Libellé',


        ];
    }

    public static function getNomFraisList()
{
    $fraisList = self::find()->select(['id', 'type'])->asArray()->all();
    return \yii\helpers\ArrayHelper::map($fraisList, 'id', 'type');
}

}
