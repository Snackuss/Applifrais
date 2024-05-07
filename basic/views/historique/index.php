<?php
use app\models\Horsforfait;
use app\models\Forfait;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $horsforfaitSearchModel app\models\HorsforfaitSearch */
/* @var $horsforfaitDataProvider yii\data\ActiveDataProvider */
/* @var $forfaitSearchModel app\models\ForfaitSearch */
/* @var $forfaitDataProvider yii\data\ActiveDataProvider */

$this->title = 'Historique';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="historique-index">
    <div class="pdfjs">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::tag('h2', 'Mois sélectionné : ' . (isset($selectedMonth) ? date('F', mktime(0, 0, 0, intval($selectedMonth), 1)) : '')) ?>

    <?php
    $form = ActiveForm::begin([
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
    ]);

    $months = [];
    for ($i = 11; $i >= 0; $i--) {
        $timestamp = strtotime("-$i months");
        $month = date('m', $timestamp);
        $year = date('Y', $timestamp);
        $label = ucfirst(date('F', $timestamp)) . ' ' . $year;
        $months[$month] = $label;
    }

    echo $form->field($forfaitSearchModel, 'month')->dropDownList($months, ['prompt' => 'Select a month', 'class' => 'form-control']);

    echo Html::submitButton('Afficher', ['class' => 'btn btn-primary']);

    ActiveForm::end();
    ?>

    <h2>Horsforfait</h2>
    <?= GridView::widget([
        'dataProvider' => $horsforfaitDataProvider,
        // 'filterModel' => $horsforfaitSearchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            'date',
            'description',
            [
                'attribute' => 'amount', 
                'contentOptions' => ['class' => 'texte-droite'], 
                'value' => function ($model) {
                  return $model->amount. ' €'; 
                },
                ],
            'attachement',
        ],
    ]); ?>

    <h2>Forfait</h2>
    <?= GridView::widget([
        'dataProvider' => $forfaitDataProvider,
        // 'filterModel' => $forfaitSearchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            'frais.type',
            'date',
            'nombre',
        ],
    ]); ?>
    
    <h1 class="tt">Montant Total des Frais: <?= $totalAmount ?> €</h1>
    </div>

    <script src="<?php echo Yii::getAlias('@web') . '/html2pdf.js-master/dist/html2pdf.bundle.min.js'; ?>"></script>
    <button id="btn-generate-pdf">Générer PDF</button>
    <script>
        document.getElementById('btn-generate-pdf').addEventListener('click', function() {
            const element = document.body;
            
            // Ajout du titre
            const title = document.createElement('h1');
            title.textContent = 'Historique des frais';
            element.insertBefore(title, element.firstChild);

            // Vérification et ajout du tableau Forfait
            const forfaitTable = document.getElementById('w1');
            if (forfaitTable) {
                const forfaitTableClone = forfaitTable.cloneNode(true);
                element.appendChild(forfaitTableClone);
            }

            // Vérification et ajout du tableau Hors Forfait
            const horsforfaitTable = document.getElementById('w0');
            if (horsforfaitTable) {
                const horsforfaitTableClone = horsforfaitTable.cloneNode(true);
                element.appendChild(horsforfaitTableClone);
            }

            // Vérification et ajout du montant total
            const totalAmountElement = document.querySelector('.tt');
            if (totalAmountElement) {
                const totalAmount = totalAmountElement.textContent.split(':')[1].trim();
                const totalAmountElementClone = document.createElement('p');
                totalAmountElementClone.textContent = "Montant total : " + totalAmount;
                element.appendChild(totalAmountElementClone);
            }

            // Téléchargement du fichier PDF avec html2pdf
            html2pdf().from(element).save('historique_frais_html2pdf.pdf');
        });
    </script>
</div>