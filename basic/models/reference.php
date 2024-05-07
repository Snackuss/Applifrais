<?php

namespace app\models;

use yii\db\ActiveRecord;

class Reference extends ActiveRecord
{
    public static function tableName()
    {
        return 'reference';
    }

    public function rules()
    {
        return [
            // Définir les règles de validation des attributs du modèle
        ];
    }

    public function attributeLabels()
    {
        return [
            // Définir les étiquettes des attributs du modèle
        ];
    }

    // Définir les relations avec d'autres modèles si nécessaire
}
