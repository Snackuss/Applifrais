<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Forfait $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="forfait-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_u')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'id_frais')->dropDownList(\app\models\Frais::getNomFraisList(), ['prompt' => 'Sélectionnez un frais']) ?>

    <?= $form->field($model, 'date')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'nombre')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Enregistrer', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
