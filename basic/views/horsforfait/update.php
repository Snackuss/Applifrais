<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Horsforfait $model */

$this->title = 'Update Horsforfait: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Horsforfaits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="horsforfait-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
