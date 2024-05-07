<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Horsforfait;

/**
 * HorsforfaitSearch represents the model behind the search form of `app\models\Horsforfait`.
 */
class HorsforfaitSearch extends Horsforfait
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_u'], 'integer'],
            [['amount'], 'number','min' => 0],
            [['date', 'description', 'attachement', 'month'], 'safe'],
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
        $query = Horsforfait::find();

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

            if ($selectedMonth !== null) {
                // Filtrez par mois si une valeur est sélectionnée
                $query->andFilterWhere(['MONTH(date)' => $selectedMonth])
                      ->andFilterWhere(['YEAR(date)' => $selectedYear]);
            }
            else {
                // Aucun mois sélectionné, ne faites pas la requête
                $query->andWhere('0=1');
            }


        return $dataProvider;
    
    
    }

}