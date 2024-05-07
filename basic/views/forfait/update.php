<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Forfait $model */

$this->title = 'Update Forfait: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Forfaits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="forfait-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
