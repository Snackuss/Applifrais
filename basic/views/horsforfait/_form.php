<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Horsforfait $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="horsforfait-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    <?= $form->field($model, 'id_u')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'date')->textInput(['type' => 'date', 'max' => date('Y-m-d')]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['type' => 'number', 'step' => '0.01']) ?>

    <?= $form->field($model, 'attachement')->fileInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Enregistrer', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
