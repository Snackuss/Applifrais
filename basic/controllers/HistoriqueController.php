<?php

namespace app\controllers;

use app\models\Horsforfait;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use app\models\HorsforfaitSearch;
use app\models\ForfaitSearch;
use app\models\Reference;
use mPDF;

class HistoriqueController extends Controller
{

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $utilisateurConnecte = Yii::$app->user->identity;
        $forfaitSearchModel = new ForfaitSearch();
        $horsforfaitSearchModel = new HorsforfaitSearch();

        // Récupérer le mois sélectionné ou utiliser le mois en cours par défaut
        $selectedMonth = Yii::$app->request->get('ForfaitSearch')['month'] ?? date('m');
        $selectedYear = date('Y');

        // Appliquer les filtres de recherche
        $forfaitDataProvider = $forfaitSearchModel->search(Yii::$app->request->queryParams);
        $forfaitDataProvider->query->andFilterWhere(['id_u' => $utilisateurConnecte->id])
            ->andFilterWhere(['MONTH(date)' => $selectedMonth])
            ->andFilterWhere(['YEAR(date)' => $selectedYear]);

        $horsforfaitDataProvider = $horsforfaitSearchModel->search(Yii::$app->request->queryParams);
        $horsforfaitDataProvider->query->andFilterWhere(['id_u' => $utilisateurConnecte->id])
            ->andFilterWhere(['MONTH(date)' => $selectedMonth])
            ->andFilterWhere(['YEAR(date)' => $selectedYear]);

        // Initialisation des variables de montant total
        $forfaitTotal = 0;
        $horsforfaitTotal = 0;
        $totalAmount = 0;

        // Calcul du montant total des frais de forfait
        foreach ($forfaitDataProvider->models as $forfait) {
            if ($forfait->frais !== null) {
                if ($forfait->frais->type === 'Frais Kilométrique') {
                    $vehicule = $utilisateurConnecte->vehicule;
                    $reference = Reference::findOne(['id_chevaux' => $vehicule]);
                    if ($reference !== null) {
                        $forfaitTotal += $forfait->nombre * $reference->quotient;
                    }
                } else {
                    if ($forfait->frais->montant !== null) {
                        $forfaitTotal += intval($forfait->nombre) * floatval($forfait->frais->montant);
                    }
                }
            }
        }

        // Calcul du montant total des frais hors forfait
        $horsforfaitTotal = $horsforfaitDataProvider->query->sum('amount');
        
        // Calcul du montant total
        $totalAmount = $forfaitTotal + $horsforfaitTotal;

        return $this->render('index', [
            'forfaitSearchModel' => $forfaitSearchModel,
            'forfaitDataProvider' => $forfaitDataProvider,
            'horsforfaitSearchModel' => $horsforfaitSearchModel,
            'horsforfaitDataProvider' => $horsforfaitDataProvider,
            'forfaitTotal' => $forfaitTotal,
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
            'totalAmount' => $totalAmount,
        ]);
    }

    private function getMonths()
    {
        $months = [];
        $currentMonth = date('n');
        $currentYear = date('Y');

        for ($i = 0; $i < 12; $i++) {
            $month = $currentMonth - $i;
            $year = $currentYear;

            if ($month <= 0) {
                $month += 12;
                $year--;
            }

            $months[date('Y-m', strtotime("$year-$month"))] = date('F Y', strtotime("$year-$month"));
        }

        return $months;
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Horsforfait::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
