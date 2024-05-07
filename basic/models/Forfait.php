<?php

namespace app\models;


/**
 * This is the model class for table "fortfait".
 *
 * @property int $id
 * @property int $id_u
 * @property int $id_frais
 * @property string $date
 */
class Forfait extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'forfait';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_u', 'id_frais', 'date'], 'required'],
            [['id_u', 'id_frais'], 'integer'],
            [['date'], 'safe'],
            ['nombre', 'required'],
            ['nombre', 'integer', 'min' => 0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_u' => 'Id U',
            'id_frais' => 'Libellé',
            'date' => 'Date',
            'nombre' => 'Quantité',

        ];
    }


    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'id_u']);
    }

    public function getFrais()
{
    return $this->hasOne(Frais::class, ['id' => 'id_frais']);
}

public function getForfait()
{
    return $this->hasOne(Forfait::class, ['id' => 'nombre']);
}

public $month;

    
}
