<?php

namespace app\models;

/**
 * This is the model class for table "horsforfait".
 *
 * @property int $id
 * @property int $id_u
 * @property string $date
 * @property string|null $description
 * @property int|null $amount
 * @property string|null $attachement
 */
class Horsforfait extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'horsforfait';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_u', 'date'], 'required'],
            [['id_u', 'amount'], 'number'],
            [['date'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['attachement'], 'string', 'max' => 255],
            [['attachement'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, pdf'],
            [['amount'], 'number','min' => 0],

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
            'date' => 'Date',
            'description' => 'Libellé',
            'amount' => 'Montant',
            'attachement' => 'Justificatif',
        ];
    }

    public function getFrais()
    {
        return $this->hasMany(Horsforfait::class, ['id_u' => 'id']);
    }

    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'id_u']);
    }

    
    
}