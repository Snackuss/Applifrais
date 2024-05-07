<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Forfait;

/**
 * ForfaitSearch represents the model behind the search form of `app\models\Forfait`.
 */
class ForfaitSearch extends Forfait
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_u', 'id_frais'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Forfait::find()->joinWith('frais');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // Get the selected month and year from the form
        $selectedMonth = isset($params['ForfaitSearch']['month']) ? $params['ForfaitSearch']['month'] : date('m');
        $selectedYear = date('Y');

        // Filter by the selected month and year
        $query->andFilterWhere(['MONTH(date)' => $selectedMonth])
            ->andFilterWhere(['YEAR(date)' => $selectedYear]);

        // Add other filters as needed

        return $dataProvider;
    }
}
