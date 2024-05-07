<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Frais;

class FraisSearch extends Frais
{
    public function rules()
    {
        return [
            [['id', 'id_u', 'nombre', 'montant'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Frais::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_u' => $this->id_u,
            'date' => $this->date,
            'nombre' => $this->nombre,
            'montant' => $this->montant,
        ]);

        return $dataProvider;
    }
}
