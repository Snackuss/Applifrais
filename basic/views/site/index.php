<?php
/** @var yii\web\View $this */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'GSB';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Bonjour</h1>



        <p>
            <?php if (Yii::$app->user->isGuest): ?>
    <a href="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>" class="btn btn-primary">Se connecter</a>
        <?php endif; ?>
        </p>
    </div>



<?php if (!Yii::$app->user->isGuest): ?>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <br>

    <?= $form->field($model, 'CarteGrise')->fileInput() ?>
    <p>Votre nom de fichier doit être de cette forme : CarteGrise_VotreNom.pdf</p>

    <?= \yii\helpers\Html::submitButton('Insérer', ['class' => 'btn btn-primary']) ?>

    <?php ActiveForm::end(); ?>
<?php endif; ?>





