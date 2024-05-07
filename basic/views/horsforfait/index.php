<?php

use app\models\Horsforfait;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/** @var yii\web\View $this */
/** @var app\models\HorsforfaitSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Horsforfaits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="horsforfait-index">

    
    <?php
function MtoFr($month){
    switch ($month) {
        case '01':
            return 'Janvier';
            break;
        case '02':
            return 'Février';
            break;
        case '03':
            return 'Mars';
            break;
        case '04':
            return 'Avril';
            break;
        case '05':
            return 'Mai';
            break;
        case '06':
            return 'Juin';
            break;
        case '07':
            return 'Juillet';
            break;
        case '08':
            return 'Août';
            break;
        case '09':
            return 'Septembre';
            break;
        case '10':
            return 'Octobre';
            break;
        case '11':
            return 'Novembre';
            break;
        case '12':
            return 'Décembre';
            break;
    }
}
$this->title = 'Frais Forfaits du mois de ' .MtoFr(date('m'));
?>
<h1><?= Html::encode($this->title) ?></h1>



    <p>
        <?= Html::a('Ajouter un Frais', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

 



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            'date',
            'description',
            [
                'attribute' => 'amount',
                'contentOptions' => ['class' => 'texte-droite'],
                'value' => function ($model) {
                    return $model->amount . ' €';
                },
            ],
            'attachement',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Horsforfait $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <h1 class="tt">Montant Total des Frais: <?= $totalAmount ?> €</h1>

    <style>
        .tt {
            text-align: right;
        }
    </style>

</div>
