<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property string $pseudo
 * @property string $mot_de_passe
 * @property int $autre_table_id
 * @property string $created_at
 * @property string $updated_at
 * @property int $id_company
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nom', 'prenom', 'pseudo', 'mot_de_passe', 'id_company'], 'required'],
            [[ 'id_company'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nom', 'prenom', 'pseudo', 'mot_de_passe'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nom' => 'Nom',
            'prenom' => 'Prenom',
            'pseudo' => 'Pseudo',
            'mot_de_passe' => 'Mot De Passe',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'id_company' => 'Id Company',
        ];
    }

    public function getFrais()
{
    return $this->hasMany(Horsforfait::class, ['id_u' => 'id']);
}

public function getUser()
{
    return $this->hasOne(User::class, ['id' => 'id_u']);
}




}


